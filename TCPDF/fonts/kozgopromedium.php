<?php

/**
 * Describes a CID-keyed font for use with Ghostscript.
 */
class CIDFont {
    /**
     * @var string The font type
     */
    private $type;

    /**
     * @var string The font name
     */
    private $name;

    /**
     * @var string The font display name
     */
    private $displayname;

    /**
     * @var array The font description
     */
    private $desc;

    /**
     * @var array The CID info
     */
    private $cidinfo;

    /**
     * @var string The encoding
     */
    private $enc;

    /**
     * @var int The underline position
     */
    private $up;

    /**
     * @var int The underline thickness
     */
    private $ut;

    /**
     * @var int The design width
     */
    private $dw;

    /**
     * @var array The character widths
     */
    private $cw;

    /**
     * @var array The character ranges
     */
    private $cr;

    /**
     * Constructs a new CIDFont object.
     *
     * @param string $type The font type
     * @param string $name The font name
     * @param string $displayname The font display name
     * @param array $desc The font description
     * @param array $cidinfo The CID info
     * @param string $enc The encoding
     * @param int $up The underline position
     * @param int $ut The underline thickness
     * @param int $dw The design width
     * @param array $cw The character widths
     * @param array $cr The character ranges
     */
    public function __construct(
        string $type,
        string $name,
        string $displayname,
        array $desc,
        array $cidinfo,
        string $enc,
        int $up,
        int $ut,
        int $dw,
        array $cw,
        array $cr
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->displayname = $displayname;
        $this->desc = $desc;
        $this->cidinfo = $cidinfo;
        $this->enc = $enc;
        $this->up = $up;
        $this->ut = $ut;
        $this->dw = $dw;
        $this->cw = $cw;
        $this->cr = $cr;

        // Set character widths for character ranges
        foreach ($cr as $range) {
            list($start, $end, $width) = $range;
            for ($i = $start; $i <= $end; $i++) {
                if (!isset($this->cw[$i])) {
                    $this->cw[$i] = $width;
                }
            }
        }
    }

    /**
     * Returns the CIDFont data as a string.
     *
     * @return string
     */
    public function __toString() {
        $data = <<<EOF
{$this->type}
{$this->name}
{$this->displayname}

EOF;

        // Desc
        $data .= sprintf("%d %d %d %d\n", $this->desc['Ascent'], $this->desc['Descent'], $this->desc['CapHeight'], $this->desc['Flags']);
        $data .= sprintf("%d %d %d %d %d %d %d %d\n", $this->desc['FontBBox'][0], $this->desc['FontBBox'][1], $this->desc['FontBBox'][2], $this->desc['FontBBox'][3], $this->desc['ItalicAngle'], $this->desc['StemV'], $this->desc['Style'], $this->desc['XHeight']);

        // CID info
        $data .= sprintf("%s %s %s\n", $this->cidinfo['Registry'], $this->cidinfo['Ordering'], $this->cidinfo['Supplement']);

        // Encoding
        $data .= $this->enc . "\n";

        // Character widths
        foreach ($this->cw as $code => $width) {
            $data .= sprintf("%d %d\n", $code, $width);
        }

        // Character ranges
        foreach ($this->cr as $range) {
            list($start, $end, $width) = $range;
            $data .= sprintf("%d %d %d\n", $start, $end, $width);
        }

        return $data;
    }
}

$type = 'cidfont0';
$name = 'KozGoPro-Medium-Acro';
$displayname = 'Kozuka Gothic Pro (Japanese Sans-Serif)';
$desc = [
    'Ascent' => 880,
    'Descent' => -120,
    'CapHeight' => 763,
    'Flags' => 4,
    'FontBBox' => [-149, -374, 1254, 1008],
    'ItalicAngle' => 0,
    'StemV' => 99,
    'Style' => '<< /Panose <0000020b0700000000000000> >>',
    'XHeight
