#!/bin/bash

# Variables
_sep="=============================================================================="
_working="........"
_success="++++++++"
_failure="--------"

copyEnvFile(){
    echo $_working" Attempting to copy the .env file now..."
    if [ -f .env ]
    then
        echo $_working" An .env file already exists."
    else
        cp -n .env.example .env
        echo $_working" The .env file copied."
    fi
}
runComposerUpdate(){
    echo $_working" Attempting to run 'composer update' now..."
    composer update
}
generateAppKey(){
    echo $_working" Attempting to run 'php artisan key:generate' now..."
    php artisan key:generate
}
installYarn(){
    echo $_working" Attempting to run 'yarn install' now..."
    yarn install
}
runYarn(){
    echo $_working" Attempting to run 'yarn run production' now..."
    yarn run production
}
serverWithArtisanAndOpenChrome(){
    echo $_working" Attempting to run 'php artisan serve' and open Chrome now..."
    php artisan serve --port 3000 & open -b com.google.Chrome http://127.0.0.1:3000
}

runActions(){
    if copyEnvFile ; then
        echo $_sep
        echo $_success" Successfully finished with .env file."
        echo $_sep
        if runComposerUpdate ; then
            echo $_sep
            echo $_success" Successfully ran composer update"
            echo $_sep
            if generateAppKey ; then
                echo $_sep
                echo $_success" Successfully generated app key"
                echo $_sep
                if installYarn ; then
                    echo $_sep
                    echo $_success" Successfully installed dependencies with yarn"
                    echo $_sep
                    if runYarn ; then
                        echo $_sep
                        echo $_success" Successfully compiled dependencies with yarn"
                        echo $_sep
                        if serverWithArtisan ; then
                            echo $_sep
                            echo $_success" Successfully served the taco time."
                            echo $_sep
                        else
                            echo $_sep
                            echo $_failure" FAILED to serve taco time with php artisan serve"
                            echo $_sep
                            exit 1
                        fi
                    else
                        echo $_sep
                        echo $_failure" FAILED to compile dependencies with yarn"
                        echo $_sep
                        exit 1
                    fi
                else
                    echo $_sep
                    echo $_failure" FAILED to install dependencies with yarn"
                    echo $_sep
                    exit 1
                fi
            else
                echo $_sep
                echo $_failure" FAILED to generate app key"
                echo $_sep
                exit 1
            fi
        else
            echo $_sep
            echo $_failure" FAILED to run composer update"
            echo $_sep
            exit 1
        fi
    else
        echo $_sep
        echo $_failure" FAILED at .env copy file step."
        echo $_sep
        exit 1
    fi

    # copyEnvFile
    # runComposerUpdate
    # generateAppKey
    # installYarn
    # runYarn
    # serverWithArtisan

}

runActions
