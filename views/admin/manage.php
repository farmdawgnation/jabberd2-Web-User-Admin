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
						<td><?= $user['jid'] ?>@<?= $user['realm'] ?></td>
						<td>
							<a href="#">Edit</a> |
							<a href="#">Delete</a>
						</td>
					</tr>
				<? } ?>
			</table>
			
			<p>
				<a href="?controller=admin&action=addUser">Add New User</a>
			</p>
		</div>
	</div>