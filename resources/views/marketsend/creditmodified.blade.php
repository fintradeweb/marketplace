<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>MarketPlace</title>
</head>
<body>
  <p>Your credit has been modified.</p>
  <p>The approved values are:</p>
  <p>PO</p>
  <ul>
    <li>PO Credit Line: ${{ $creditpo->credit_line }}</li>
    <li>PO Advance: ${{ $creditpo->advance }}</li>
    <li>PO Maximum amount: ${{ $creditpo->maximum_amount }}</li>
    <li>PO Deadline: {{ $creditpo->deadline }}</li>
    <li>PO Interest Rate: {{ $creditpo->interest_rate }}</li>
  </ul>
  <p>Invoice</p>
  <ul>
    <li>Invoice Credit Line: ${{ $creditinvoice->credit_line }}</li>
    <li>Invoice Advance: ${{ $creditinvoice->advance }}</li>
    <li>Invoice Maximum amount: ${{ $creditinvoice->maximum_amount }}</li>
    <li>Invoice Deadline: {{ $creditinvoice->deadline }}</li>
    <li>Invoice Interest Rate: {{ $creditinvoice->interest_rate }}</li>
  </ul>
  <ul>
    <li>
      <a href="http://protomarket.fintrade-acf.com/">Enter our platform</a>
    </li>
  </ul>
</body>
</html>
