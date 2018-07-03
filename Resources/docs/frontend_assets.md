## Rebuilding assets
In case you want to rebuild the static scripts or need a build for a custom environment.

### System requirements

TODO kevin - describe how to install dependencies and re-generate the frontend assets + webpack/webpack + encore/yarn/npm


### Install vendor scripts

Execute `yarn install` to install the dependencies for this theme. 
    
### Build asset files

To re-generate the asset files execute: 

```
npm run build
```

These new assets will be stored at `Resources/public/`.

## Subdirectory usage

The AdminLTE theme comes pre-compiled for usage at domain level. If your application runs under a subdirectory,
you have to change a line in the file [webpack.config.js](https://github.com/kevinpapst/AdminLTEBundle/blob/master/webpack.config.js#L8) from:

```
    .setPublicPath('/bundles/adminlte/')
```

to your subdirectory. 

Lets say run app runs at https://www.example.com/my-app/ then you need to change it to:

```
    .setPublicPath('/my-app/bundles/adminlte/')
```

This path is used for referencing assets from the users browser, so the generated path must be an absolute path to 
the directory `my-app/public/bundles/adminlte/`.

## Next steps

Please go back to the [AdminLTE bundle documentation](README.md) to find out more about using the theme.
