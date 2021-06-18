<template>
    <div class="container mt-5">
        <div class="row">
            <h4>Listagem</h4>
            <div class="col-sm-3 ml-auto mt-2 text-right">
                Total de registros: {{ tot_registro }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'cabecalho',
    props: {
        tot_registro: {
            type: Number,
            default: 0
        }
    }
}
</script>