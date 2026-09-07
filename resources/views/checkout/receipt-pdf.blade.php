<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu {{ $order->order_number }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; padding: 40px; color: #1a1a1a; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #c9a96e, #a88b4a); margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px; }
        h1 { font-size: 24px; margin-bottom: 5px; }
        .info { background: #f8f8f8; padding: 20px; border-radius: 12px; margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e4e4e4; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #1a1a1a; color: white; padding: 10px; text-align: left; font-size: 12px; text-transform: uppercase; }
        td { padding: 10px; border-bottom: 1px solid #e4e4e4; font-size: 14px; }
        .total { font-size: 18px; font-weight: bold; text-align: right; color: #c9a96e; }
        .footer { margin-top: 40px; padding-top: 20px; border-top: 2px solid #1a1a1a; text-align: center; font-size: 12px; color: #737373; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">HS</div>
        <h1>Home Store - Chic Living</h1>
        <p>Cocody, Abidjan, Côte d'Ivoire</p>
        <p>Tél: +225 01 00 00 00 00</p>
    </div>

    <div class="info">
        <div class="info-row"><span>Commande N°</span><span class="font-mono font-bold">{{ $order->order_number }}</span></div>
        <div class="info-row"><span>Date</span><span>{{ $order->created_at->format('d/m/Y H:i') }}</span></div>
        <div class="info-row"><span>Client</span><span>{{ $order->user->name }}</span></div>
        <div class="info-row"><span>Paiement</span><span>{{ match($order->payment_method) { 'boutique' => 'Paiement en boutique', 'mobile_money' => 'Mobile Money', 'virement' => 'Virement', 'livraison' => 'À la livraison', default => $order->payment_method } }}</span></div>
    </div>

    <table>
        <thead>
            <tr><th>Article</th><th>Qté</th><th>Prix</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>x{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product_price, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">Total: {{ number_format($order->total, 0, ',', ' ') }} FCFA</div>

    <div class="footer">
        <p><strong>Merci pour votre commande !</strong></p>
        <p>Présentez ce reçu en boutique pour finaliser votre paiement et récupérer vos articles.</p>
        <p>Réservation valable 48h.</p>
    </div>
</body>
</html>
