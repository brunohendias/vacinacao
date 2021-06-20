<template>
    <form class="form">
        <div class="row">
            <div class="col-sm-3">
                <pacientes :filtro="body" />
            </div>
            <div class="col-sm-3">
                <vacinas :filtro="body" />
            </div>
            <div class="col-sm-2">
                <label for="data_vacinacao">Data da vacinação: </label>
                <input class="form-control" type="date" name="data_vacinacao" v-model="body.data_vacinacao" required />
            </div>
            <div class="col-sm-2">
                <label for="id_dose">Identificação da dose: </label>
                <input class="form-control" type="text" name="id_dose" v-model="body.id_dose" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="00000000" />
            </div>
            <cadastro :body="body" :disable="disable" :web="web"/>
        </div>
    </form>
</template>

<script>
import pacientes from '../shared/select/paciente.vue'
import vacinas from '../shared/select/vacina.vue'
import cadastro from '../botao/cadastro.vue'

export default {
    name: 'historicoCadastro',
    components: {
        pacientes,
        vacinas,
        cadastro
    },
    data() {
        return {
            body: {
                data_vacinacao: null,
                cod_paciente: null,
                cod_vacina: null,
                id_dose: null
            },
            web: '/historico'
        }
    },
    computed: {
        disable() {
            return !this.body.data_vacinacao  || !this.body.cod_paciente
                || !this.body.cod_vacina || !this.body.id_dose
        }
    }
}
</script>