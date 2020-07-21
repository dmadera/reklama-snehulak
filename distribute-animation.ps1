if($args.Count -ne 2) { exit 1 }

$input = $args[0]
$output = $args[1]

if($input -eq "") { exit 1 }
if($output -eq "") { exit 1 }

if(-Not (Test-Path $input -PathType Leaf)) { exit 1}

$maxTime = 360;
$interval = 20;

For ($i=0; $i -lt $maxTime/$interval; $i++) {
    Start-Sleep -Seconds $interval
    try {
        [IO.File]::OpenWrite($output).close();
        Copy-Item $input $output -Force
        break
    } catch {}
}
