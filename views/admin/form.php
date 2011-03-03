	<div id="content_box">
		<h1>
			jabberd2-webuseradmin
			<span><?= $_SESSION['logged_in'] ?></span>
		</h1>
		
		<? view::load('common_nav') ?>
		
		<div id="text_box">
			<h2>User Editor</h2>
			
			<p>
				Please enter or edit data about the user below. If you are editing
				an existing user, be aware that putting a value in their password
				field will result in their password being changed, while leaving
				it blank will result in it being left alone.
			</p>
			
			<form method="post">
				<div class="field">
					<label>Username:</label>
					<input type="text" name="username" value="<?= $user['username'] ?>" />
				</div>
				<div class="field">
					<label>Realm:</label>
					<input type="text" name="realm" value="<?= $user['realm'] ?>" />
				</div>
				<div class="field">
					<label>Password:</label>
					<input type="password" name="password" />
				</div>
				
				<div class="submit">
					<input type="submit" value="Save User" />
				</div>
			</form>
		</div>
	</div>