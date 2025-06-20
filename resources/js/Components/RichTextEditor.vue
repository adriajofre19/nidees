<script setup>
import { ref, watch, onBeforeUnmount } from 'vue'
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Underline from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'
import Heading from '@tiptap/extension-heading'
import TextAlign from '@tiptap/extension-text-align'

const props = defineProps({ modelValue: String })
const emit = defineEmits(['update:modelValue'])

const editor = new Editor({
  content: props.modelValue || '',
  extensions: [
    StarterKit,
    Underline,
    Link.configure({ openOnClick: false }),
    Heading.configure({ levels: [1, 2, 3] }),
    TextAlign.configure({ types: ['heading', 'paragraph'] }),
  ],
  editorProps: {
    attributes: {
      class: 'min-h-[200px] px-4 py-3 prose prose-sm focus:outline-none',
    },
  },
  onUpdate({ editor }) {
    emit('update:modelValue', editor.getHTML())
  },
})

watch(() => props.modelValue, (value) => {
  if (editor && value !== editor.getHTML()) {
    editor.commands.setContent(value)
  }
})

onBeforeUnmount(() => {
  editor.destroy()
})

// Estado de los botones
const buttons = ref([])

function updateButtons() {
  buttons.value = [
    {
      label: 'B',
      action: () => editor.chain().focus().toggleBold().run(),
      active: editor.isActive('bold'),
    },
    {
      label: 'I',
      action: () => editor.chain().focus().toggleItalic().run(),
      active: editor.isActive('italic'),
    },
    {
      label: 'U',
      action: () => editor.chain().focus().toggleUnderline().run(),
      active: editor.isActive('underline'),
    },
    {
      label: '¶',
      action: () => editor.chain().focus().setParagraph().run(),
      active: editor.isActive('paragraph'),
    },
    {
      label: 'H2',
      action: () => editor.chain().focus().toggleHeading({ level: 2 }).run(),
      active: editor.isActive('heading', { level: 2 }),
    },
    {
      label: 'H3',
      action: () => editor.chain().focus().toggleHeading({ level: 3 }).run(),
      active: editor.isActive('heading', { level: 3 }),
    },
    {
      label: '⬅',
      action: () => editor.chain().focus().setTextAlign('left').run(),
      active: editor.isActive({ textAlign: 'left' }),
    },
    {
      label: '↔',
      action: () => editor.chain().focus().setTextAlign('center').run(),
      active: editor.isActive({ textAlign: 'center' }),
    },
    {
      label: '➡',
      action: () => editor.chain().focus().setTextAlign('right').run(),
      active: editor.isActive({ textAlign: 'right' }),
    },
    {
      label: '🔗',
      action: () => {
        const url = prompt('Introduce la URL')
        if (url) editor.chain().focus().setLink({ href: url }).run()
      },
      active: editor.isActive('link'),
    },
  ]
}

// Actualizar el estado de los botones al cambiar selección o escribir
editor.on('selectionUpdate', updateButtons)
editor.on('transaction', updateButtons)

// Llamar una vez al inicio
updateButtons()
</script>

<template>
  <div class="border rounded-xl shadow-sm w-full bg-white overflow-hidden">
    <!-- Toolbar -->
    <div class="flex flex-wrap items-center gap-1 px-3 py-2 border-b bg-gray-50">
      <button
        v-for="(btn, index) in buttons"
        :key="index"
        @click="btn.action"
        type="button"
        :class="[
          'btn-toolbar',
          btn.active ? 'bg-gray-300 font-bold' : 'bg-white'
        ]"
        v-html="btn.label"
      />
    </div>

    <!-- Editor -->
    <EditorContent :editor="editor" class="bg-white w-full px-4 py-3" />
  </div>
</template>

<style scoped>
.btn-toolbar {
  @apply px-2 py-1 text-sm border border-gray-300 rounded-md hover:bg-gray-100 transition shadow-sm;
}
</style>
