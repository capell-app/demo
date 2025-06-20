import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/codewithdennis/filament-simple-alert/resources/**/*.blade.php',
        './vendor/cms-multi/admin/resources/**/*.blade.php',
        './vendor/cms-multi/admin/src/Enums/ModalWidthEnum.php',
        './vendor/cms-multi/blog/resources/**/*.blade.php',
        './vendor/cms-multi/filament-clear-cache/resources/**/*.blade.php',
        './vendor/cms-multi/system/resources/**/*.blade.php',
    ],
}
