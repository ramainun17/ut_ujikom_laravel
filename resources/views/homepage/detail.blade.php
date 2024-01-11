<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>  
    <div class="container">
        <div class="mt-5">
            <p>Terima kasih atas pemesanan Anda. Silakan lakukan pembayaran untuk melanjutkan proses.</p>
            <div class="card">
                <h5 class="card-header bg-dark"><span class="text-light">Detail Transaksi</span></h5>
                <div class="card-body">
                    <table>
                        <tbody>
                            <tr>
                                <td><strong><span>Kode Transaksi</strong></td>
                                <td> : <span>{{ $transaksi->kode_transaksi }}</span></td>
                            </tr>
                            <tr>
                                <td><strong><span>Layanan</span></strong></td>
                                <td> : <span>{{ $transaksi->order->layanan->nama_layanan }}</span></td>
                            </tr>
                            <tr>
                                <td><strong><span>Total Harga</span></strong></td>
                                <td> : <span>Rp. {{ number_format($transaksi->total_harga, 2) }}</span></td>
                            </tr>
                            <tr>
                                <td><strong><span>Tambahan</span></strong></td>
                                <td>: 
                                    @foreach ($transaksi->order->produk as $n)
                                    <span>
                                        {{ $n->nama_produk }},
                                    </span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><strong><span>Status Pembayaran</span></strong></td>
                                <td> : 
                                    @if($transaksi->status == 0)
                                        <span class="badge bg-danger text-wrap">Belum Dibayar</span></td>
                                    @elseif($transaksi->status == 1)
                                    <span class="badge bg-success text-wrap">Sudah Dibayar</span></td>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-grid gap-2 col-3 mx-auto mt-3">
                <button id="pay-button" class="btn btn-success btn-lg">Pembayaran</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
              /* You may add your own implementation here */
              alert("payment success!"); console.log(result);
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          })
        });
      </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</html>