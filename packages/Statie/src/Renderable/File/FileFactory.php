<?php declare(strict_types=1);

namespace Symplify\Statie\Renderable\File;

use Nette\Utils\Strings;
use SplFileInfo;
use Symplify\Statie\Configuration\Configuration;

final class FileFactory
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param SplFileInfo[] $fileInfos
     * @return AbstractFile[]
     */
    public function createFromFileInfos(array $fileInfos): array
    {
        $files = [];
        foreach ($fileInfos as $id => $fileInfo) {
            $files[$id] = $this->create($fileInfo);
        }

        return $files;
    }

    public function createFromFilePath(string $filePath): AbstractFile
    {
        return $this->create(new SplFileInfo($filePath));
    }

    /**
     * @return File|PostFile
     */
    public function create(SplFileInfo $file): AbstractFile
    {
        $relativeSource = substr($file->getPathname(), strlen($this->configuration->getSourceDirectory()));
        $relativeSource = ltrim($relativeSource, DIRECTORY_SEPARATOR);

        if (Strings::contains($file->getPath(), DIRECTORY_SEPARATOR . '_posts')) {
            return new PostFile($file, $relativeSource, $file->getPathname());
        }

        return new File($file, $relativeSource, $file->getPathname());
    }
}
