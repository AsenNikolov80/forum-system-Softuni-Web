<div>
    <form id="addForm" action="<?= ROOT_URL . 'answer/addNew/' . $questionId ?>" method="POST">

        <div>Username: <input type="text" name="username" required 
                              value="<?php echo $this->userLogged != null ? $this->userLogged['username'] : ''; ?>" /></div>
        <div>Email: <input type="email" name="email"
                           value="<?php echo $this->userLogged != null ? $this->userLogged['email'] : ''; ?>" /></div>
        <div>Your answer: <textarea name="text" required></textarea></div>
        <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
        <input type="submit" name="addAnswer" value="Add answer!"/>
    </form>
</div>