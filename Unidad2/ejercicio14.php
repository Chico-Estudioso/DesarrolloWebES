<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <form action="ejercicio14_tratamiento.php" method="get">
        <fieldset>
            <legend>Datos personales</legend>
            <div>
                <label>Nombre</label>
                <br>
                <input type="text" name="nombre" />
            </div>
            <div>
                <label>Contraseña</label>
                <br>
                <input type="password" name="ps" />
            </div>
            <div>
                <label>Sexo</label>
                <br>
                <input type="radio" name="sexo" checked="cheked" />Hombre
                <input type="radio" name="sexo" />Mujer
            </div>
            <div>
                <label>Fecha</label>
                <br>
                <input type="date" name="fecha" />
            </div>
            <div>
                <label>Pais</label>
                <br>
                <select name="pais" multiple="multiple">
                    <option selected="selected">España</option>
                    <option>Fracia</option>
                    <option>Italia</option>
                </select>
            </div>

    </form>
    </fieldset>
    <fieldset>
        <legend>Información adicional</legend>
        <div>
            <label>Nº de hijos</label>
            <br>
            <select name="nHijos">
                <option>1</option>
                <option selected="selected">2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
    </fieldset>
</body>

</html>