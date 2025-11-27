<?php

function renderList($data) {
    echo '<div class="alert alert-info"><h5 class="alert-heading">Defined vars:</h5>';
    echo '<pre style="background:#f8f9fa;border:1px solid #dee2e6;padding:1rem;overflow:auto">';
    echo htmlspecialchars(print_r($data, true));
    echo '</pre>';
    echo '</ul></div>';
}

function array_to_badges($arr)
{
    $html = '';
    
    foreach ($arr ?? [] as $item) {
        $html .= '<span class="badge bg-primary text-white">' . $item . '</span>';
    }

    return $html;
}

?>