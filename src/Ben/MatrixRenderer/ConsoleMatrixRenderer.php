<?php
namespace Ben\MatrixRenderer;
use CLIFramework\Component\Table\Table;
use CLIFramework\Component\Table\CompactTableStyle;
use CLIFramework\Component\Table\BorderlessTableStyle;
use CLIFramework\Logger;

class ConsoleMatrixRenderer
{
    public function __construct(Table $table = null)
    {
        if (!$table) {
            $table = new Table;
            $table->setStyle(new CompactTableStyle);
            $table->setStyle(new BorderlessTableStyle);
        }
        $this->table = $table;
    }

    public function render(Array $matrix)
    {
        $table = clone $this->table;
        $table->setHeaders(array_merge(["--"], array_keys($matrix)));
        foreach ($matrix as $aId => $aRows) {
            $row = [$aId];
            foreach ($aRows as $bId => $ratio) {
                $row[] = $ratio;
            }
            $table->addRow($row);
        }
        return $table->render();
    }
}



