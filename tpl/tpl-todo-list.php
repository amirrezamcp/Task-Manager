<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> <?= SITE_TITEL ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
            <li class="<?= isset($_GET['folder_id']) ? '' : 'active' ?>"><i class=" fa  <?= (!isset($_GET['folder_id']))? 'fa-folder-open' : 'fa-folder' ?>"></i> All </li>
          <?php foreach($folders as $folder): ?>
            <li class=" <?= (!empty($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'active' : '' ?> ">
              <a href="?folder_id=<?= $folder->id ?>"><i class="fa  <?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'fa-folder-open' : 'fa-folder' ?> "></i><?= $folder->name ?></a>
              <a href="?delete_folder=<?= $folder->id ?>"><i class="remove fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this item?')"></i></a>
            </li>
            <?php endforeach; ?>
          </ul>
      </div>
      <div>
          <input type="text" id="addFolderInput" style="width: 65%; margin-left: 3%" placeholder="Add New Folder"/>
          <button id="addFolderBtn" class="btn clickable">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <input type="text" id="addTaskInput" style="width: 50%; margin-left: 3%; line-height: 30px; position: absolute;" placeholder="Add New Folder"/>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php foreach($tasks as $task) : ?>
            <li class="<?= $task->is_done ? 'checked' : '' ?>">
              <i class="fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o' ?>"></i>
              <span><?= $task->title ?></span>
              <div class="info">
                <span class='created-at'>Created At <?= $task->created_at ?></span>
                <a href="?delete_task=<?= $task->id ?>"><i class="remove fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this item?')"></i></a>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="<?= BASE_URL ?>assets/js/script.js"></script>
  <script>
    $(document).ready(function() {
      $('#addFolderBtn').click(function(e) {
        var inputFolder = $('input#addFolderInput');
        $.ajax({
          url: "prosses/ajaxHandler.php",
          method: "post",
          data: {action : "addFolder", folderName : inputFolder.val()},
          success: function(response) {
            if (response == '1'){
              location.reload();
            }else {
              alert(response);
            }
          }
        });
      });
    });
  </script>
</body>
</html>
