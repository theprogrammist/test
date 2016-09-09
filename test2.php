<?php
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];

function parseTree($data)
{
    $result = [];
    foreach ($data as $k => $v) {
        $arr = explode('.', $k);

        $link = &$result;
        for ($i = 0; $i < count($arr); $i++) {
            $link = &$link[$arr[$i]];
        }

        $link = $v;
    }

    return $result;
}

print_r(parseTree($data1));

function stringifyTree($data)
{
    /**
     * function recursively join nodes of branch into string
     * returns leaf by closure &$val
     * and removes the branch from initial array
     */
    $joinBranchToStingRecursive = function (&$el) use (&$joinBranchToStingRecursive, &$value) {
        if (is_array($el)) {
            $key = key($el);

            $theRest = $joinBranchToStingRecursive($el[$key]);

            //remove the node if it is the last or empty
            if (!is_array($el[$key]) or empty($el[$key]))
                unset($el[$key]);

            //omit ending point
            return $key . ($theRest ? '.' . $theRest : '');

        } else {
            $value = $el;
            return null;
        }
    };


    $result = [];
    while (count($data)) {
        $result[$joinBranchToStingRecursive($data)] = $value;
    }

    return $result;
}

print_r(stringifyTree($data));

?>