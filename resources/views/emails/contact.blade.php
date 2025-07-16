<!DOCTYPE html>
<html lang="ca">
<head>
  <meta charset="UTF-8">
  <title>Nou missatge de contacte</title>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Comfortaa', sans-serif; background: linear-gradient(135deg, #f0f9f4 0%, #e6f7ed 100%); margin: 0; padding: 20px; color: #1f2937;">
  <table style="max-width: 650px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(34, 197, 94, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);">
    
    <!-- Header -->
    <tr>
      <td style="padding: 0; background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); position: relative;">
        <div style="padding: 32px 24px; text-align: center; position: relative;">
          <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"20\" cy=\"20\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"80\" cy=\"40\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"40\" cy=\"80\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg></div>
          <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 600; letter-spacing: -0.5px; position: relative; z-index: 1;">
            📬 Nou missatge de contacte
          </h1>
          <p style="margin: 8px 0 0 0; color: rgba(255, 255, 255, 0.9); font-size: 14px; font-weight: 400; position: relative; z-index: 1;">
            Rebut des del teu lloc web
          </p>
        </div>
      </td>
    </tr>

    <!-- Content -->
    <tr>
      <td style="padding: 40px 32px;">
        <div style="margin-bottom: 32px;">
          <p style="margin: 0; font-size: 16px; line-height: 1.6; color: #374151; font-weight: 400;">
            Has rebut un nou missatge a través del formulari de contacte. Aquí tens els detalls:
          </p>
        </div>

        <!-- Contact Details Card -->
        <div style="background: linear-gradient(135deg, #f0fdf4 0%, #f7fee7 100%); border-radius: 12px; padding: 24px; margin-bottom: 24px; border-left: 4px solid #10b981;">
          <table style="width: 100%; border-collapse: collapse;">
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid rgba(16, 185, 129, 0.1);">
                <div style="display: flex; align-items: center;">
                  <span style="font-size: 18px; margin-right: 12px;">👤</span>
                  <div>
                    <strong style="color: #059669; font-weight: 600; font-size: 14px; display: block; margin-bottom: 4px;">Nom i cognoms</strong>
                    <span style="color: #374151; font-size: 16px; font-weight: 500;">{{ $data['name'] }}</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid rgba(16, 185, 129, 0.1);">
                <div style="display: flex; align-items: center;">
                  <span style="font-size: 18px; margin-right: 12px;">📧</span>
                  <div>
                    <strong style="color: #059669; font-weight: 600; font-size: 14px; display: block; margin-bottom: 4px;">Correu electrònic</strong>
                    <a href="mailto:{{ $data['email'] }}" style="color: #10b981; font-size: 16px; font-weight: 500; text-decoration: none;">{{ $data['email'] }}</a>
                  </div>
                </div>
              </td>
            </tr>
            @if(!empty($data['subject']))
            <tr>
              <td style="padding: 12px 0; border-bottom: 1px solid rgba(16, 185, 129, 0.1);">
                <div style="display: flex; align-items: center;">
                  <span style="font-size: 18px; margin-right: 12px;">📝</span>
                  <div>
                    <strong style="color: #059669; font-weight: 600; font-size: 14px; display: block; margin-bottom: 4px;">Assumpte</strong>
                    <span style="color: #374151; font-size: 16px; font-weight: 500;">{{ $data['subject'] }}</span>
                  </div>
                </div>
              </td>
            </tr>
            @endif
            @if(!empty($data['message']))
            <tr>
              <td style="padding: 12px 0;">
                <div style="display: flex; align-items: flex-start;">
                  <span style="font-size: 18px; margin-right: 12px; margin-top: 2px;">💬</span>
                  <div style="flex: 1;">
                    <strong style="color: #059669; font-weight: 600; font-size: 14px; display: block; margin-bottom: 8px;">Missatge</strong>
                    <div style="background: #ffffff; padding: 16px; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.2); color: #374151; font-size: 15px; line-height: 1.6;">
                      {!! nl2br(e($data['message'])) !!}
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            @endif
          </table>
        </div>

        <!-- Action Button -->
        <div style="text-align: center; margin: 32px 0;">
          <a href="mailto:{{ $data['email'] }}" style="display: inline-block; background: linear-gradient(135deg, #059669 0%, #10b981 100%); color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-weight: 600; font-size: 14px; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;">
            ✉️ Respondre directament
          </a>
        </div>

        <!-- Footer -->
        <div style="border-top: 2px solid #f0fdf4; padding-top: 24px; margin-top: 32px;">
          <div style="background: #f8fafc; border-radius: 8px; padding: 16px; text-align: center;">
            <p style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">
              🤖 Aquest missatge ha estat enviat automàticament des del teu lloc web.<br>
              <span style="color: #10b981; font-weight: 500;">Si no esperaves aquest correu, pots ignorar-lo amb seguretat.</span>
            </p>
          </div>
        </div>
      </td>
    </tr>

    <!-- Bottom accent -->
    <tr>
      <td style="padding: 0;">
        <div style="height: 4px; background: linear-gradient(90deg, #059669 0%, #10b981 50%, #34d399 100%);"></div>
      </td>
    </tr>
  </table>

  <!-- Subtle background decoration -->
  <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; pointer-events: none; z-index: -1;">
    <div style="position: absolute; top: 20%; left: 10%; width: 100px; height: 100px; background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: 30%; right: 15%; width: 150px; height: 150px; background: radial-gradient(circle, rgba(52, 211, 153, 0.03) 0%, transparent 70%); border-radius: 50%;"></div>
  </div>
</body>
</html>