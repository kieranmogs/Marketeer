<?php
require_once ("../stargatemc.php");
class marketeer extends stargatemc {
        function __construct () {
                $handle = fopen("./marketdata.csv", "r");
                if ($handle) {
                    while (($entry = fgets($handle)) !== false) {
                                                $data = explode(",",$entry);
                                                $name = $this->clean($data[4]);
                                                $buyprice = $this->clean($data[5]);
                                                $sellprice = $this->clean($data[6]);
                                                $itemid = $data[1].":".$data[2];
                                                echo "Found item with name: ".$name." Buyprice: ".$buyprice. " Sellprice: ".$sellprice." and item ID: ".$itemid."\n";
                                                $this->runMinecraftCommand("heal bysokar");
                                                $this->runMinecraftCommand("eco set bysokar 100000");
                                                $this->runMinecraftCommand("clear Bysokar");
                                                $this->runMinecraftCommand("/give Bysokar ".$itemid." 1");
                                                sleep(1);
                                                if ($sellprice != "0") {
                                                        $this->runMinecraftCommand("sudo Bysokar market create ".$this->clean($sellprice)." 1 -inf");
                                                }
                                                $this->runMinecraftCommand("sudo Bysokar setworth ".$itemid." ".$buyprice);
                                                sleep(1);
                }
                fclose($handle);
                }
        }
}

$marketeer = new marketeer();
