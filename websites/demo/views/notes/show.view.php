<?php

require base_path( 'views/partials/head.php');
 
require base_path( 'views/partials/nav.php');

require base_path( 'views/partials/banner.php');


?>



<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
            
    <p class="mb-6">
      <a href="<?=$GLOBALS['root']?>notes" class='text-blue-500 hover:underline'> Go back... </a>
    </p>

    <p> <?= htmlspecialchars( $note['body'] ); ?> </p>
        

    <footer class="mt-6" >
      <a href="/websites/demo/note/edit?id=<?= $note['id']?>"
        class="text-green-700 border border-current px-2 py-1 rounded"> 
        
            Edit 
      </a>
    </footer>





    <form class="mt-6" action="" method="post">

      <input type="hidden" name="_method" value="DELETE" >
      <input type="hidden" name="id" value="<?= $note['id'] ?>" >
      <button class="text-sm text-red-500">
        Delete
      </button>

    </form>
    
  </div>
</main>


<?php
require base_path( 'views/partials/footer.php');

?>