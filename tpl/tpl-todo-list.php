<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> <?= SITE_TITEL ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/todo-list.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
        <a href="<?= site_url("?logout=1") ?>"><i class="fa fa-sign-out"></i></a>
        <span class="username"> <?= $user->name ?? 'Unknown' ?> </span>
        <img src="<?= $user->image ?? "$grav_url" ?>" width="40" height="40"/>
    </div>
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
            <li class="<?= isset($_GET['folder_id']) ? '' : 'active' ?>">
              <a href="<?= site_url() ?>"><i class=" fa  <?= (!isset($_GET['folder_id']))? 'fa-folder-open' : 'fa-folder' ?>"></i> All </li></a>
          <?php foreach($folders as $folder): ?>
            <li class=" <?= (!empty($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'active' : '' ?> ">
              <a href="<?= site_url("?folder_id= $folder->id") ?>"><i class="fa  <?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'fa-folder-open' : 'fa-folder' ?> "></i><?= $folder->name ?></a>
              <a href="<?= site_url("?delete_folder= $folder->id") ?>"><i class="remove fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this item?')"></i></a>
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
              <i data-taskId="<?= $task->id ?>" class="isDone clickable fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o' ?>"></i>
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
  <script  src="<?= BASE_URL ?>assets/js/todo-list.js"></script>
  <script>
    $(document).ready(function() {
      // check is Done
      $('.isDone').click(function(e) {
        var isDoneTaskId = $(this).attr('data-taskId');
        $.ajax({
          url: "prosses/ajaxHandler.php",
          method: "post",
          data: {action : "doneSwitch", taskId : isDoneTaskId},
          success: function(response) {
            location.reload();
          }
        });
      });
      // Add Folder
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
        // Add Tasks
        $('#addTaskInput').on('keypress', function(e) {
            if(e.which == 13) {
              $.ajax({
              url: "prosses/ajaxHandler.php",
              method: "post",
              data: {action : "addTask", folderId : <?= $_GET['folder_id'] ?? 0 ?>, taskTitle : $('#addTaskInput').val()},
              success: function(response) {
                if (response == '1'){
                  location.reload();
                }else {
                  alert(response);
                }
              }
            });
          }
        });
        $('#addTaskInput').focus();
      });
  </script>
</body>
</html>