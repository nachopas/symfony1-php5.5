<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\Set\ValueObject\LevelSetList;

use PhpParser\Node;
use PhpParser\Node\Stmt\InlineHTML;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class RemoveSemicolonBeforePhpCloseRector extends AbstractRector
{
    public function getNodeTypes(): array
    {
        // This rule targets inline PHP close tags
        return [InlineHTML::class];
    }

    public function refactor(Node $node): ?Node
    {
        // Locate the content of the node
        $content = $node->value;

        // Match PHP code blocks with exactly one expression and a semicolon before the closing tag
        if (preg_match('/<\?php\s+([^;]+);\s*\?>/s', $content, $matches)) {
            // Replace the semicolon if there's exactly one expression
            $updatedContent = preg_replace('/;\s*\?>/', ' ?>', $content);

            // Update the content only if modified
            if ($updatedContent !== $content) {
                $node->value = $updatedContent;
                return $node;
            }
        }

        // Return null if no changes are made
        return null;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Removes unnecessary semicolons before PHP close tags if there is exactly one expression',
            []
        );
    }
}

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/data/bin',
        __DIR__ . '/lib',
    ])
    // uncomment to reach your current PHP version
    // ->withPhpSets()
    ->withRules([
        RemoveAlwaysElseRector::class,
        RemoveSemicolonBeforePhpCloseRector::class,
    ])
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0)
    ->withSets([LevelSetList::UP_TO_PHP_83])
;
