<?php require 'php/db_conn.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <main> 
    <section>
      <div class="container">
        <div class="show-todo-section">
          <ion-icon name="checkbox-outline"></ion-icon>          
          <h1> To-Do List</h1>
          <div class="wrapper">
            <form action="php/add.php" method="post" autocomplete="off">
              <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input class="input-item" type="text" name="title" style="border-color: red" placeholder="This field is required">
                <button class="btn-add" type="submit">Add Task &nbsp;<span>&#43;</span></button>
              <?php } else { ?>
                <input class="input-item" type="text" name="title" placeholder="What do you need to do?">
                <button class="btn-add" type="submit">Add &nbsp;<span>&#43;</span></button>
              <?php } ?>
            </form>
            <?php $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC"); ?>
            <div class="item-container">
                
              <?php if($todos->rowCount() <= 0) { ?>
                <div class="todo-item">
                  <div class="empty">
                    <img src="img/loading.gif" width="80px" alt="" />
                  </div>
                </div>
              <?php } ?>

              <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                  <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>

                  <?php if($todo['checked']) { ?>
                    <input type="checkbox" class="check-box" checked />
                    <h2 class="checked"><?php echo $todo['title'] ?></h2>
                  <?php } else { ?>
                    <input type="checkbox" class="check-box" />
                    <h2><?php echo $todo['title'] ?></h2>
                  <?php } ?>

                  <small>Created: <?php echo $todo['date_time'] ?></small>
                </div>
              <?php } ?>


            </div> 
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="js/script.js"></script>
</body>
</html>