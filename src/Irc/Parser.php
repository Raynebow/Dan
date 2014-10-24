<?php namespace Dan\Irc; 


class Parser {

    /**
     * Parses IRC lines to make them easy to use.
     *
     * @param $line
     * @return array
     */
    public static function parseLine($line)
    {
        $data      = str_split($line);
        $parsed     = [];
        $userInfo   = [];

        $buffer     = "";
        $inString   = false;
        $in005      = false;
        $userStr    = false;

        for($i = 0; $i < count($data); $i++)
        {
            if(count($parsed) > 0)
                if($data[$i] == '=' && $parsed[0] == '005')
                    $in005 = true;

            if($i == 0 && $data[$i] == ':')
            {
                $userStr = true;
                continue;
            }

            if(($data[$i] == '!' || $data[$i] == '@' || $data[$i] == ' ') && $userStr)
            {
                $userInfo[] = $buffer;
                $buffer = '';

                if($data[$i] == ' ')
                    $userStr = false;

                continue;
            }

            if ($data[$i] == ':' && (!$inString && !$in005))
            {
                $inString = true;
                continue;
            }

            if ($data[$i] == ' ' && !$inString)
            {
                $parsed[]   = $buffer;
                $buffer     = "";
                $in005      = false;
                continue;
            }

            $buffer .= $data[$i];
        }

        if($buffer != '')
            $parsed[] = trim($buffer);

        $parsed = array_filter($parsed);

        return ['cmd' => $parsed, 'user' => $userInfo];
    }
}
 