# Don't forget Set-ExecutionPolicy RemoteSigned - Yes to All

$logFile = "log-$(gc env:computername).log"
$logLevel = "DEBUG" # ("DEBUG","INFO","WARN","ERROR","FATAL")
$logSize = 3mb # 30kb
$logCount = 1
$destination = "$PSScriptRoot\animation.gif"
$last_moddate = "$PSScriptRoot\lastmoddate"

##################################################################
# START LOGGER
##################################################################

function Write-Log-Line ($line) {
    Add-Content $logFile -Value $Line
    Write-Host $Line
}

# http://stackoverflow.com/a/38738942
Function Write-Log {
    [CmdletBinding()]
    Param(
    [Parameter(Mandatory=$True)]
    [string]
    $Message,
    
    [Parameter(Mandatory=$False)]
    [String]
    $Level = "DEBUG"
    )

    $levels = ("DEBUG","INFO","WARN","ERROR","FATAL")
    $logLevelPos = [array]::IndexOf($levels, $logLevel)
    $levelPos = [array]::IndexOf($levels, $Level)
    $Stamp = (Get-Date).toString("yyyy/MM/dd HH:mm:ss:fff")

    if ($logLevelPos -lt 0){
        Write-Log-Line "$Stamp ERROR Wrong logLevel configuration [$logLevel]"
    }
    
    if ($levelPos -lt 0){
        Write-Log-Line "$Stamp ERROR Wrong log level parameter [$Level]"
    }

    # if level parameter is wrong or configuration is wrong I still want to see the 
    # message in log
    if ($levelPos -lt $logLevelPos -and $levelPos -ge 0 -and $logLevelPos -ge 0){
        return
    }

    $Line = "$Stamp $Level $Message"
    Write-Log-Line $Line
}

# https://gallery.technet.microsoft.com/scriptcenter/PowerShell-Script-to-Roll-a96ec7d4
function Reset-Log 
{ 
    # function checks to see if file in question is larger than the paramater specified 
    # if it is it will roll a log and delete the oldes log if there are more than x logs. 
    param([string]$fileName, [int64]$filesize = 1mb , [int] $logcount = 5) 
     
    $logRollStatus = $true 
    if(test-path $filename) 
    { 
        $file = Get-ChildItem $filename 
        if((($file).length) -ige $filesize) #this starts the log roll 
        { 
            $fileDir = $file.Directory 
            #this gets the name of the file we started with 
            $fn = $file.name
            $files = Get-ChildItem $filedir | ?{$_.name -like "$fn*"} | Sort-Object lastwritetime 
            #this gets the fullname of the file we started with 
            $filefullname = $file.fullname
            #$logcount +=1 #add one to the count as the base file is one more than the count 
            for ($i = ($files.count); $i -gt 0; $i--) 
            {  
                #[int]$fileNumber = ($f).name.Trim($file.name) #gets the current number of 
                # the file we are on 
                $files = Get-ChildItem $filedir | ?{$_.name -like "$fn*"} | Sort-Object lastwritetime 
                $operatingFile = $files | ?{($_.name).trim($fn) -eq $i} 
                if ($operatingfile) 
                 {$operatingFilenumber = ($files | ?{($_.name).trim($fn) -eq $i}).name.trim($fn)} 
                else 
                {$operatingFilenumber = $null} 
 
                if(($operatingFilenumber -eq $null) -and ($i -ne 1) -and ($i -lt $logcount)) 
                { 
                    $operatingFilenumber = $i 
                    $newfilename = "$filefullname.$operatingFilenumber" 
                    $operatingFile = $files | ?{($_.name).trim($fn) -eq ($i-1)} 
                    write-host "moving to $newfilename" 
                    move-item ($operatingFile.FullName) -Destination $newfilename -Force 
                } 
                elseif($i -ge $logcount) 
                { 
                    if($operatingFilenumber -eq $null) 
                    {  
                        $operatingFilenumber = $i - 1 
                        $operatingFile = $files | ?{($_.name).trim($fn) -eq $operatingFilenumber} 
                        
                    } 
                    write-host "deleting " ($operatingFile.FullName) 
                    remove-item ($operatingFile.FullName) -Force 
                } 
                elseif($i -eq 1) 
                { 
                    $operatingFilenumber = 1 
                    $newfilename = "$filefullname.$operatingFilenumber" 
                    write-host "moving to $newfilename" 
                    move-item $filefullname -Destination $newfilename -Force 
                } 
                else 
                { 
                    $operatingFilenumber = $i +1  
                    $newfilename = "$filefullname.$operatingFilenumber" 
                    $operatingFile = $files | ?{($_.name).trim($fn) -eq ($i-1)} 
                    write-host "moving to $newfilename" 
                    move-item ($operatingFile.FullName) -Destination $newfilename -Force    
                } 
            } 
          } 
         else 
         { $logRollStatus = $false} 
    } 
    else 
    { 
        $logrollStatus = $false 
    } 
    $LogRollStatus 
} 

# to null to avoid output
$Null = @(
    Reset-Log -fileName $logFile -filesize $logSize -logcount $logCount
)

##################################################################
# END LOGGER
##################################################################

function Gif-to-Mp4 {
    $input = $args[0]
    $output = $args[1]
    & "$PSScriptRoot\ffmpeg.exe" -i "$input" -f gif -movflags faststart -pix_fmt yuv420p -vf "scale=trunc(iw/2)*2:trunc(ih/2)*2" "$output" -y
}

Write-Log "Started" "INFO"

try {
    $url = "https://www.reklama-snehulak.cz/media/lock"
    $output = "$PSScriptRoot\lock"

    $wc = New-Object System.Net.WebClient
    $wc.DownloadFile($url, $output)
} catch {}

if(Test-Path $output -PathType Leaf) {
    Write-Log "Lock file exists!" "ERROR"
    exit 1
}


try {
    $url = "https://www.reklama-snehulak.cz/media/animation.gif"
    $date_remote = Get-Date ((cmd.exe /c "curl -sI $url") | select-string -pattern 'Last-Modified: (.*)').Matches.groups[1].value
    
    $tmp_animation = "$PSScriptRoot\animation-tmp.gif"

    if((Test-Path $destination -PathType Leaf) -AND (Test-Path $last_moddate -PathType Leaf)) {
        $date_local = Get-Date (Get-Content -Path $last_moddate)

        if($date_remote -eq $date_local) {
            Write-Log "Files are the same modification date." "INFO"
            exit 0
        }
    }
    $wc.DownloadFile($url, $tmp_animation)
    $date_remote | Set-Content $last_moddate
} catch {
    $ErrorMessage = $_.Exception.Message
    Write-Log "Unable to download animation file. $ErrorMessage" "ERROR"
    exit 2
}

if(Test-Path $tmp_animation -PathType Leaf) {
    Write-Log "Animation file downloaded!" "INFO"
    try {
        # trying to write to first file
        [IO.File]::OpenWrite($destination).close();
        Copy-Item $tmp_animation $destination
        Write-Log "Animation file overwritten to $destination." "INFO"
        exit 0
    } catch {
        Write-Log "Unable to write gif file. $destination" "ERROR"
        exit 1
    } finally {
        Remove-Item $tmp_animation
    }
} else {
    Write-Log "Unable to download animation file. File doesn't exist." "ERROR"
    exit 2
}
