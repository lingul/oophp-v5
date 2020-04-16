<?php
/**
 * Dice controller
 */
return [
    "mount" => "dice",

    // All routes in order
    "routes" => [
        [
            "info" => "Dice controller.",
            "mount" => "",
            "handler" => "\ligm19\Dice\DiceController",
        ],
        [
            "info" => "Dice controller.",
            "mount" => "new",
            "handler" => "\ligm19\Dice\DiceController",
        ],
        [
            "info" => "Dice controller.",
            "mount" => "game",
            "handler" => "\ligm19\Dice\DiceController",
        ],
        [
            "info" => "Dice controller.",
            "mount" => "doai",
            "handler" => "\ligm19\Dice\DiceController",
        ],
        [
            "info" => "Dice controller.",
            "mount" => "roll",
            "handler" => "\ligm19\Dice\DiceController",
        ],
        [
            "info" => "Dice controller.",
            "mount" => "pass",
            "handler" => "\ligm19\Dice\DiceController",
        ],
    ]
];
