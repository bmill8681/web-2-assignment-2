Please don't work in the master branch. When you start working, open up git cmd line interface and enter:

	git checkout [yourname]

This will switch you into your branch if you're not already in it.

Second - if we work on the same files, we get merge conflicts. So we need to break up the work into parts and combine them.
We can talk about that in person so we're all in agreement as to who is doing what.

Commands:

	git add -A			<-- stages ALL changes that have been made to be committed.
	git add [path/file]		<-- stages specific files
	git commit -m "msg"		<-- commits your changes to your local repository. replace 'msg' with a short description
					of the changes you've made.
	git push			<-- pushes the items you've commited to the github repository online.
	git pull origin [branch] 	<-- pulls changes from the branch name into your branch. often the branch will be "master"
					Will often result in merge conflicts! be careful what you delete!

Learning 

This is something else