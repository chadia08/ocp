<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="overflow-x:scroll;">
        <table class="table m-1 mb-5" style="width:100%;">
            <tr class="thead">
                <th>code_article</th>
                <th>descriptif</th>
                <th>description</th>
                <th>code_famille</th>
                <th>unite</th>
                <th>categorie</th>
                <th>nature</th>
                <th>qte_demandée</th>
                <th>prix</th>
                <th>service</th>
                <th>personne</th>
                <th>installation</th>
                <th>justification</th>
                <th>date_sortie</th>
                <th>action</th>
            </tr>
            @foreach($pdrs as $pdr)
            <tr>
                <td>{{$pdr->code_article}}</td>
                <td>{{$pdr->descriptif}}</td>
                <td>{{$pdr->description}}</td>
                <td>{{$pdr->code_famille}}</td>
                <td>{{$pdr->unite}}</td>
                <td>{{$pdr->categorie}}</td>
                <td>{{$pdr->nature}}</td>
                <td>{{$pdr->qte_sortie}}</td>
                <td>{{$pdr->pmp}}</td>

                <td>{{$pdr->service}}</td>
                <td>{{$pdr->personne}}</td>
                <td>{{$pdr->installation}}</td>
                <td>{{$pdr->justification}}</td>
                <td>{{$pdr->date_entree}}</td>
                <td>ouiiii</td>
            </tr>
        </table>
    </div>
</body>
</html>