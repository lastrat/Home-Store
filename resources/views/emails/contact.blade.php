<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact - Home Store</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; padding: 40px; color: #1a1a1a; background: #f5f5f5; }
        .container { max-width: 700px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; }
        .header { background: #15171C; padding: 30px; text-align: center; }
        .header h1 { color: white; font-size: 24px; margin: 0; }
        .body { padding: 30px; }
        .info-row { display: flex; padding: 12px 0; border-bottom: 1px solid #e4e4e4; }
        .info-label { font-weight: 600; width: 120px; color: #666; }
        .info-value { flex: 1; color: #1a1a1a; }
        .message-box { background: #f8f8f8; padding: 20px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #C18E41; }
        .message-box h3 { margin-top: 0; color: #1a1a1a; }
        .footer { padding: 20px 30px; text-align: center; color: #737373; font-size: 12px; border-top: 1px solid #e4e4e4; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Home Store - Chic Living</h1>
        </div>
        <div class="body">
            <h2>Nouveau message de contact</h2>
            <p>Vous avez reçu un nouveau message depuis le formulaire de contact du site.</p>

            <div class="info-row">
                <div class="info-label">Nom:</div>
                <div class="info-value">{{ $data['name'] }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $data['email'] }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Sujet:</div>
                <div class="info-value">{{ $data['subject'] }}</div>
            </div>

            <div class="message-box">
                <h3>Message:</h3>
                <p>{{ nl2br(e($data['message'])) }}</p>
            </div>
        </div>
        <div class="footer">
            <p>Home Store - Chic Living | {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
