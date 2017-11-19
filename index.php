<?php
require_once __DIR__ . '/generator.php';
$inspirator = Inspirator::getInstance();
$columnCount = count($inspirator->getColumns());
$output = isset($_POST) && isset($_POST['generate']) ? $inspirator->generate($_POST['columns']) : '';
$values = $inspirator->getValues();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inspiration Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column">
          <form action="" method="post">
            <div class="field is-grouped">
              <div class="control">
                <button class="button" name="generate" value="1" type="submit">Thing</button>
              </div>
              <div class="control">
                <button class="button" name="generate" value="2" type="submit">Doing what?</button>
              </div>
              <div class="control">
                <button class="button" name="generate" value="3" type="submit">Where?</button>
              </div>
              <div class="control">
                <button class="button" name="generate" value="0" type="submit">All</button>
              </div>
            </div>
            <?php if (!empty($output)) :
                for ($i=1; $i <= $columnCount; $i++) : ?>
            <input type="hidden" name="columns[<?php echo $i; ?>]" value="<?php echo $values[$i]; ?>">
                <?php endfor;
            endif; ?>
          </form>
        </div>
        <?php if (!empty($output)) : ?>
        <div class="column"><?php echo $output; ?></div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</body>
</html>
