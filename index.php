<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank account</title>
</head>

<body>
  <?php 
    $bank_account1 = [
      "balance"=> 400,
      "overdraft_limit"=> 0,
    ];
    $bank_account2 = [
      "balance"=> 200,
      "overdraft_limit"=> 100,
    ];
    function depositMoney(array $bank_account, int|float $amount) : void {
      echo "Doing transaction deposit (+" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      $bank_account["balance"] += abs($amount);
      echo "My new balance after deposit (+" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }

    function withdrawMoney(array $bank_account, int|float $amount) : void {
      echo "Doing transaction withdrawal (-" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      if (($bank_account["balance"] - abs($amount)) < 0){
        echo "Error transaction: Insufficient balance to complete withdrawal.";
        echo "<br>";
        return;
      }
      $bank_account["balance"] -= abs($amount);
      echo "My new balance after deposit (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }
  ?>
</body>

</html>