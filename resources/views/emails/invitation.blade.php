<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f3f4f6; padding: 40px 20px; }
        .card { max-width: 480px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); padding: 32px; text-align: center; }
        .header h1 { color: #fff; font-size: 20px; margin: 0; }
        .header p { color: rgba(255,255,255,0.8); font-size: 13px; margin-top: 4px; }
        .body { padding: 32px; text-align: center; }
        .body p { color: #4b5563; font-size: 14px; line-height: 1.6; margin: 0 0 24px; }
        .btn { display: inline-block; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; padding: 12px 32px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 14px; }
        .footer { padding: 16px 32px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { color: #9ca3af; font-size: 11px; margin: 0; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>🏠 EasyColoc</h1>
            <p>Invitation to join a colocation</p>
        </div>
        <div class="body">
            <p>You've been invited to join <strong>{{ $colocation->name }}</strong>. Click the button below to accept the invitation and start sharing expenses.</p>
            <a href="{{ $url }}" class="btn">Accept Invitation</a>
            <p style="margin-top: 24px; font-size: 12px; color: #9ca3af;">This invitation expires in 24 hours.</p>
        </div>
        <div class="footer">
            <p>If you didn't expect this, you can safely ignore it.</p>
        </div>
    </div>
</body>
</html>
