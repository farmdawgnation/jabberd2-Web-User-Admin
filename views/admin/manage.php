	<div id="content_box">
		<h1>
			jabberd2-webuseradmin
			<span><?= $_SESSION['logged_in'] ?></span>
		</h1>
		
		<? view::load('common_nav') ?>
		
		<div id="text_box">
			<h2>User Manager</h2>
			
			<table style="width: 100%">
				<tr>
					<th>JID</th>
					<th>Actions</th>
				</tr>
				<? foreach($users as $user) { ?>
					<tr>
						<td><?= $user['username'] ?>@<?= $user['realm'] ?></td>
						<td>
							<a href="?controller=admin&action=editUser&jid=<?= $user['username'] ?>@<?= $user['realm'] ?>">Edit</a> |
							<a href="?controller=admin&action=deleteUser&jid=<?= $user['username'] ?>@<?= $user['realm'] ?>" onclick="return confirm('This action cannot be reversed. Proceed?')">Delete</a>
						</td>
					</tr>
				<? } ?>
			</table>
			
			<p>
				<a href="?controller=admin&action=addUser">Add New User</a>
			</p>
		</div>
	</div>