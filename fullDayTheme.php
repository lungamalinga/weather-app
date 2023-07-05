<?php

function getFullTheme($desc)
{
    $description = $desc;
    $bg_color = '';
    $temp_color = '';
    $min_color = '';
    $max_color = '';
    $icon = '';

    $fullTheme = [
        'bg color' => $bg_color,
        'temp color' => $temp_color,
        'min color' => $min_color,
        'max color' => $max_color,
        'icon' => $icon
    ];

    # 
    # bg colors ->  sunny > #E1D880. cloudy > #45A1CA. thunderstorm > #0F232C. snow > #B1DCEC. rain > #29799E
    # tem colors -> sunny > #45A1CA. cloudy > #E3D588. thunderstorm > #E3D588. snow > #0E212B. rain > #E5D67F
    # min colors -> sunny > #104E5C. cloudy > #fff. thunderstorm > whiyr. snow > #25566F. rain > white

    if ($description == 'clear sky') {
        $icon = 'sun.svg';
        $bg_color = '#E1D880';
        $temp_color = '#45A1CA';
        $min_color = '#104E5C';
        $max_color = '#104E5C';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    } elseif ($description == 'broken clouds' or $description == 'overcast clouds') {
        $icon = 'cloud.svg';
        $bg_color = '#45A1CA';
        $temp_color = '#E3D588';
        $min_color = '#ffffff';
        $max_color = '#ffffff';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    }elseif($description == 'few clouds'){
        $icon = 'partly-cloudy.svg';
        $bg_color = '#45A1CA';
        $temp_color = '#E3D588';
        $min_color = '#ffffff';
        $max_color = '#ffffff';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    }elseif($description == 'scattered clouds'){
        $icon = 'scattered.svg';
        $bg_color = '#45A1CA';
        $temp_color = '#E3D588';
        $min_color = '#ffffff';
        $max_color = '#ffffff';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    } 
    elseif($description == 'mist'){
        $icon = 'mist.svg';
        $bg_color = '#B1DCEC';
        $temp_color = '#0E212B';
        $min_color = '#25566F';
        $max_color = '#25566F';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    }
    elseif ($description == 'thunderstorm') {
        $icon = 'thunder-storm.svg';
        $bg_color = '#0F232C';
        $temp_color = '#E3D588';
        $min_color = '#ffffff';
        $max_color = '#ffffff';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    } elseif ($description == 'snow') {
        $icon = 'snowflake.svg';
        $bg_color = '#B1DCEC';
        $temp_color = '#0E212B';
        $min_color = '#25566F';
        $max_color = '#25566F';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    } elseif ($description == 'light rain' or $description == 'shower rain' or $description == 'moderate rain') {
        $icon = 'rain.svg';
        $bg_color = '#29799E';
        $temp_color = '#E5D67F';
        $min_color = '#ffffff';
        $min_color = '#ffffff';
        //adding to the array
        $fullTheme['bg color'] = $bg_color;
        $fullTheme['temp color'] = $temp_color;
        $fullTheme['min color'] = $min_color;
        $fullTheme['max color'] = $max_color;
        $fullTheme['icon'] = $icon;
        return $fullTheme;
    } 
}

print_r(getFullTheme('clear sky')['bg color']); echo '<br>';
print_r(getFullTheme('clear sky')['temp color']); echo '<br>';
print_r(getFullTheme('clear sky')['min color']); echo '<br>';
print_r(getFullTheme('clear sky')['max color']); echo '<br>';
print_r(getFullTheme('clear sky')['icon']); echo '<br>';

?>