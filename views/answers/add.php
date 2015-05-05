<form action="<?=ROOT_URL.'answer/addNew/'.$questionId ?>" method="POST">

    <div>Username: <input type="text" name="username" required/></div>
    <div>Email: <input type="email" name="email" /></div>
    <div>Your answer: <textarea name="text" required></textarea></div>
    <input type="submit" name="addAnswer" value="Add answer!"/>
</form>