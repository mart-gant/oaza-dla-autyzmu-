<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowa wiadomość kontaktowa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: bold;
            color: #4b5563;
            margin-bottom: 5px;
        }
        .field-value {
            padding: 10px;
            background: white;
            border-radius: 5px;
            border: 1px solid #e5e7eb;
        }
        .message-box {
            background: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #e5e7eb;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            background: #374151;
            color: #9ca3af;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">🌟 Oaza dla Autyzmu</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Nowa wiadomość z formularza kontaktowego</p>
    </div>
    
    <div class="content">
        <div class="field">
            <div class="field-label">Imię i nazwisko:</div>
            <div class="field-value">{{ $data['name'] }}</div>
        </div>
        
        <div class="field">
            <div class="field-label">Adres e-mail:</div>
            <div class="field-value">
                <a href="mailto:{{ $data['email'] }}" style="color: #2563eb; text-decoration: none;">
                    {{ $data['email'] }}
                </a>
            </div>
        </div>
        
        <div class="field">
            <div class="field-label">Treść wiadomości:</div>
            <div class="message-box">{{ $data['message'] }}</div>
        </div>
        
        <div style="margin-top: 30px; padding: 15px; background: #dbeafe; border-left: 4px solid #2563eb; border-radius: 5px;">
            <p style="margin: 0; font-size: 14px;">
                💡 <strong>Wskazówka:</strong> Możesz odpowiedzieć bezpośrednio na tego maila, aby skontaktować się z nadawcą.
            </p>
        </div>
    </div>
    
    <div class="footer">
        <p style="margin: 0;">Ta wiadomość została wygenerowana automatycznie przez system Oaza dla Autyzmu.</p>
        <p style="margin: 10px 0 0 0;">&copy; 2025 Oaza dla Autyzmu</p>
    </div>
</body>
</html>
