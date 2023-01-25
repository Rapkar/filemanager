<?php

class SpaceDetail
{
    private $FreeSpace;
    private $TotalSpace;
    private $UsedSpace;
    public function __construct($root='/')
    {
        $this->FreeSpace = FREESPACEDISK;
        $this->TotalSpace = disk_total_space($root);
        $this->UsedSpace = $this->UsedSpace();
      
    }

    public function getUsedSpace()
    {

        return getSize($this->UsedSpace);
    }
    public function UsedSpace()
    {
        ob_flush();
        $usedSpace = $this->TotalSpace  - FREESPACEDISK;
        return $usedSpace;
        ob_clean();
    }
    public function getFreeSpace()
    {
        return getSize($this->FreeSpace);
    }

    public function getTotalSpace()
    {
        return getSize($this->TotalSpace);
    }
    public function getPercentOfSpace($type)
    {
        if ($type == 'Free') {
            $result = round((FREESPACEDISK / $this->TotalSpace) * 100);
        } else if ($type == 'Used') {
            $result =    round(($this->UsedSpace / $this->TotalSpace) * 100);
        }
        return $result;
    }
}
