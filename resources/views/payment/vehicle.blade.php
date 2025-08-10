<div>



  <script src="https://cdn.tailwindcss.com"></script>
<div id="printarea">
<h3 class="text-lg font-semibold mb-4">Order Details</h3>
<hr>
    <table>
        <tr>
            <td><p><strong>License Number </strong></p></td>
            <td> : {{ $vehicle->plate_number }}</td>
        </tr>
        <tr>
            <td><strong>Brand:</strong></td>
            <td> : {{ $vehicle->brand }}</td>
        </tr>

        <tr>
            <td><strong>Model:</strong></td>
            <td> : {{ $vehicle->model }}</td>
        </tr>
        <tr>
            <td><strong>Price </strong></td>
            <td> : Rp. {{ $vehicle->price }}</td>
        </tr>
        <tr>
            <td><strong>Quantity</strong></td>
            <td><input type="number" id="quantity" name="quantity" value="1" oninput="calculateTotal()" class="form-control"></td>
        </tr>
    </table>

    <div class = "row" class="border border-gray-200">
        <div class="col-md-12">
            <p><strong>Total Payment:  </strong></p> <p id = "total"> 0 </p>
        </div>


</div>


               

    </div>

     <button onclick="printDiv('printarea')" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Pay Now / Print Receipt</button>
</div>


<script>

    document.addEventListener('DOMContentLoaded', function() {
        calculateTotal();
    });

    function calculateTotal() {
        console.log('Calculating total...');
        var price = {{ $vehicle->price }};
        var quantity = document.getElementById('quantity').value;
        var total = price * quantity;
        document.getElementById('total').innerText = 'Rp. ' + total.toLocaleString();
    }


    function printDiv(divId) {
    const content = document.getElementById(divId).innerHTML;
    const printWindow = window.open('', '', 'width=600,height=400');
    printWindow.document.write(`
      <html>
        <head>
          <title>Print</title>
          <style>
            /* Add any styles needed for print */
            body { font-family: Arial, sans-serif; padding: 20px; }
          </style>
        </head>
        <body>
          ${content}
        </body>
      </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
  }
</script>