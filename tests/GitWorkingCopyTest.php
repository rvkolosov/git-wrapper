    /**
     * @var string
     */
    private const DIRECTORY = 'build/tests/wc_init';

    /**
     * @var string
     */
    private const PATCH = <<<CODE_SAMPLE
diff --git a/FileCreatedByPatch.txt b/FileCreatedByPatch.txt
new file mode 100644
index 0000000..dfe437b
--- /dev/null
+++ b/FileCreatedByPatch.txt
@@ -0,0 +1 @@
+contents

CODE_SAMPLE;

    /**
     * @var string
     */
    private $currentUserName;

    /**
     * @var string
     */
    private $currentUserEmail;

        // Create the local repository
        $this->gitWrapper->init(self::REPO_DIR, [
            'bare' => true,
        ]);
        $git = $this->gitWrapper->cloneRepository('file://' . realpath(self::REPO_DIR), self::DIRECTORY);

        // prevent local user.* override
        $this->currentUserEmail = $git->config('user.email');
        $this->currentUserName = $git->config('user.name');
        FileSystem::write(self::DIRECTORY . '/change.me', "unchanged\n");
        $this->filesystem->touch(self::DIRECTORY . '/move.me');
        $this->filesystem->mkdir(self::DIRECTORY . '/a.directory', 0755);
        $this->filesystem->touch(self::DIRECTORY . '/a.directory/remove.me');
        $git->push('origin', 'master', [
            'u' => true,
        ]);
        FileSystem::write(self::DIRECTORY . '/branch.txt', $branch . PHP_EOL);
        $git->push('origin', $branch, [
            'u' => true,
        ]);
        $this->filesystem->remove(self::DIRECTORY);
        // restore current user/email
        $gitWorkingCopy = $this->gitWrapper->workingCopy(self::REPO_DIR);
        $gitWorkingCopy->config('user.email', $this->currentUserEmail);
        $gitWorkingCopy->config('user.name', $this->currentUserName);
        FileSystem::write(self::WORKING_DIR . '/patch.txt', self::PATCH);

        // PHPUnit 8.5 compatible
        if (method_exists($this, 'assertRegExp')) {
            $this->assertRegExp('#\?\?\\s+FileCreatedByPatch\\.txt#s', $git->getStatus());
        } else {
            $this->assertMatchesRegularExpression('#\?\?\\s+FileCreatedByPatch\\.txt#s', $git->getStatus());
        }

        $expectedFileNameToExist = self::WORKING_DIR . '/untracked.file';
        // PHPUnit 10+ future compact
        if (method_exists($this, 'assertFileDoesNotExist')) {
            $this->assertFileDoesNotExist($expectedFileNameToExist);
        } else {
            $this->assertFileNotExists($expectedFileNameToExist);
        }
        $git->reset([
            'hard' => true,
        ]);
        $output = $git->status([
            's' => true,
        ]);
        $this->assertMatchesRegularExpression("/^Already up[- ]to[ -]date\.$/", rtrim($output));
        $output = $git->archive('HEAD', [
            'o' => $archivePath,
        ]);
        $this->expectExceptionMessageMatches("/Your branch is up[- ]to[- ]date with 'origin\\/master'./");






        $git->getWrapper()
            ->addOutputEventSubscriber($listener);
        $git->getWrapper()
            ->streamOutput(true);
        $git->getWrapper()
            ->streamOutput(false);
        $git->reset('HEAD~2', [
            'hard' => true,
        ]);
        $git->commit([
            'm' => '1 commit ahead.',
        ]);
        $git->reset('HEAD^', [
            'hard' => true,
        ]);
        $git->reset('HEAD^', [
            'hard' => true,
        ]);
        $git->commit([
            'm' => '1 commit ahead.',
        ]);
                [
                    '-f' => true,
                ],
        $branches = $gitWorkingCopy->getBranches()
            ->remote();
        $branches = $gitWorkingCopy->getBranches()
            ->remote();
    private function createRemote(): void