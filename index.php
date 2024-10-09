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
      "opened" => true
    ];
    $bank_account2 = [
      "balance"=> 200,
      "overdraft_limit"=> 100,
      "opened" => true
    ];
    function deposit_funds(array $bank_account, int|float $amount) : void {
      echo "Doing transaction deposit (+" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      $bank_account["balance"] += abs($amount);
      echo "My new balance after deposit (+" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }

    function withdraw_funds(array $bank_account, int|float $amount) : void {
      echo "Doing transaction withdrawal (-" . abs($amount) . ") with current balance " . number_format($bank_account["balance"], 1); 
      echo "<br>";
      if ($bank_account["overdraft_limit"] == 0 && ($bank_account["balance"] - abs($amount)) < 0){
        echo "Error transaction: Insufficient balance to complete withdrawal.";
        echo "<br>";
        return;
      }
      if($bank_account["overdraft_limit"] > 0 && ($bank_account["balance"] - abs($amount)) < 0){
        if(abs($amount)>$bank_account["overdraft_limit"]){
          echo "Error transaction: Withdrawal esceeds overdraft limit.";
          echo "<br>";
          echo "My new balance after failed withdrawal (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
          echo "<br>";
          return;
        }
        $bank_account["balance"] -= abs($amount);
        echo "My new balance after withdrawal (-" . abs($amount) . ") with funds : " . number_format($bank_account["balance"], 1);
        echo "<br>";
        return;
      }

      $bank_account["balance"] -= abs($amount);
      echo "My new balance after withdrawal (-" . abs($amount) . ") : " . number_format($bank_account["balance"], 1);
      echo "<br>";
    }
    function open_account(array $bank_account): void{
      if($bank_account["opened"]){
        echo "Error: Account is already opened";
      echo "<br>";
        return;
      }
      $bank_account["opened"] = true;
      echo "My account is now reopened.";
      echo "<br>";
    }
    function close_account(array $bank_account): void{
      if(!$bank_account["opened"]){
        echo "Error: Account is already closed";
      echo "<br>";
        return;
      }
      $bank_account["opened"] = false;
      echo "My account is now closed.";
      echo "<br>";
    }

  ?>
</body>

</html>