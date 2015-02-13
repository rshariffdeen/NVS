<?php

require_once 'lib/diag/diag.php';

//require('phpgraphlib_v2.31\phpgraphlib.php');
class PDF extends PDF_Diag {

    function Header() {
        //family, style, size
        //if($this->PageNo()!=1){
        $this->SetTextColor(100, 100, 100);
        $this->SetFont('Times', '', 8);
        $this->SetY(0);
        //width, height, text, border, ln, align
        $this->Cell(0, 25, "National Volunteering Secretariat ", '0', 0, "L");
        $this->Cell(0, 25, $this->PageNo(), '0', 0, "R");
        //reset Y
        $this->SetY(1);
        //}
    }

    function Cover($district) {
        $this->SetTextColor(000, 100, 231);
        $this->SetFont('Times', '', 22);
        $this->SetY(80);
        $this->SetX(25.4);
        $this->SetX(25.4);
        $this->Cell(0, 0, $district . ' District Report', '0', 0, "C");
    }

    function Table($topics, $data) {
        $this->SetFont('Arial', 'B', 12); //Set the Font type to Arial,Bold with size 12 Pt
        $this->SetTextColor(0); //Set the Text Color
        $this->SetFillColor(000, 188, 225); //Fill the text with RGB Color
        $this->SetLineWidth(0.2); //Set the Line Width to 1pt

        $this->Cell(30, 7, $topics[0], 'LTR', 0, 'C', true);
        $this->Cell(30, 7, $topics[1], 'LTR', 0, 'C', true);
        $this->Cell(30, 7, $topics[2], 'LTR', 0, 'C', true);
        $this->Cell(50, 7, $topics[3], 'LTR', 1, 'C', true);

        $this->SetFont('Arial', '');
        $this->SetFillColor(238);
        $this->SetLineWidth(0.2); //0.2 pts
        $fill = false;
        while ($row = mysqli_fetch_array($data)) {
            $this->Cell(30, 7, $row[$topics[0]], 1, 0, 'C', $fill);
            $this->Cell(30, 7, $row[$topics[1]], 1, 0, 'C', $fill);
            $this->Cell(30, 7, $row[$topics[2]], 1, 0, 'C', $fill);
            $this->Cell(50, 7, $row[$topics[3]], 1, 1, 'R', $fill);
            $fill = !$fill;
        }
    }

    function Graphs() {
        
    }

    function Footer() {
        //This is the footer; it's repeated on each page.
        //enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
        //y position: rough estimate, width, height, filetype, link: click it!
        //$this->Image("logo.jpg", (8.5/2)-1.5, 9.8, 3, 1, "JPG", "http://www.phpjabbers.com");
    }

    function GetMultiCellHeight($w, $h, $txt, $border = null, $align = 'J') {
        // Calculate MultiCell with automatic or explicit line breaks height
        // $border is un-used, but I kept it in the parameters to keep the call
        //   to this function consistent with MultiCell()
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $height = 0;
        while ($i < $nb) {
            // Get next character
            $c = $s[$i];
            if ($c == "\n") {
                // Explicit line break
                if ($this->ws > 0) {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                //Increase Height
                $height += $h;
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                // Automatic line break
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                    if ($this->ws > 0) {
                        $this->ws = 0;
                        $this->_out('0 Tw');
                    }
                    //Increase Height
                    $height += $h;
                } else {
                    if ($align == 'J') {
                        $this->ws = ($ns > 1) ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
                        $this->_out(sprintf('%.3F Tw', $this->ws * $this->k));
                    }
                    //Increase Height
                    $height += $h;
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
            }
            else
                $i++;
        }
        // Last chunk
        if ($this->ws > 0) {
            $this->ws = 0;
            $this->_out('0 Tw');
        }
        //Increase Height
        $height += $h;

        return $height;
    }

}

?>