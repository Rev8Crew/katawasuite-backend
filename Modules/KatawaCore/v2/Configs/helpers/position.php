<?php

use Modules\KatawaCore\v2\Modules\Dto\PositionDto;

return [
    'center' => PositionDto::make('center', 'center'),

    'right' => PositionDto::make('right', 'center'),
    'tworight' => PositionDto::make('right', 'center'),
    'bgright' => PositionDto::make('right', 'center'),
    'offscreenright' => PositionDto::make('right-in', 'center'),

    'left' => PositionDto::make('left', 'center'),
    'twoleft' => PositionDto::make('left', 'center'),
    'bgleft' => PositionDto::make('left', 'center'),
    'offscreenleft' => PositionDto::make('left-in', 'center'),

    'rightedge' => PositionDto::make('right-in', 'center'),

    // GG
    'oneleft' => PositionDto::make('left', 'center'),
    'oneright' => PositionDto::make('right', 'center'),
    'twoleftsit' => PositionDto::make('left-in', '15%'),
    'tworightsit' => PositionDto::make('right-in', '15%'),
    'leftsit' => PositionDto::make('left', '15%'),
    'rightsit' => PositionDto::make('right', '15%'),
    'centersit' => PositionDto::make('center', '15%'),
    'centersit2' => PositionDto::make('center', '07%'),
    'centersitlow' => PositionDto::make('center', '25%'),
    'twoleftsitlow' => PositionDto::make('left-in', '25%'),
    'oneleftsitlow' => PositionDto::make('left', '25%'),
    'onerightsitlow' => PositionDto::make('right', '25%'),
    'tworightsitlow' => PositionDto::make('right-in', '25%'),

    'closeleft' => PositionDto::make('left', 'center'),
    'closeright' => PositionDto::make('right', 'center'),
    'closeleft2' => PositionDto::make('0%', 'center'),

    'leftoff' => PositionDto::make('left-in', 'center'),
    'centeroff' => PositionDto::make('center', 'center'),

    'twoleftoff' => PositionDto::make('20%', 'center'),
    'tworightoff' => PositionDto::make('68%', 'center'),
    'twocenteroff' => PositionDto::make('30%', 'center'),
    'twocenteroff2' => PositionDto::make('50%', 'center'),
    'twocenteroff3' => PositionDto::make('70%', 'center'),

    'tworightstagger' => PositionDto::make('right', 'center'),

    'leftdoor' => PositionDto::make('10%', 'center'),
    'leftdooropen' => PositionDto::make('-10%', 'center'),
    'rightwallopen' => PositionDto::make('85%', 'center'),
    'roomopen' => PositionDto::make('45%', 'center'),

    'leftoffsit' => PositionDto::make('left-in', '15%'),
    'rightedgesit' => PositionDto::make('right-in', '15%'),

    'oneleftsit' => PositionDto::make('left', '15%'),
    'onerightsit' => PositionDto::make('right', '15%'),

    'leftsitlow' => PositionDto::make('left-in', '25%'),
    'rightsitlow' => PositionDto::make('right-in', '25%'),

    'rightedgetsu' => PositionDto::make('70%', 'center'),
    'tworighttsu' => PositionDto::make('70%', 'center'),
    'leftoffmiyu' => PositionDto::make('1%', 'center'),
];
