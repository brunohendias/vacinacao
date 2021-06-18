<template>
    <form class="form" @submit.prevent="submit">
        <div class="row">
            <div class="col-sm-3">
                <pacientes :filtro="body" />
            </div>
            <div class="col-sm-3">
                <vacinas :filtro="body" />
            </div>
            <div class="col-sm-2">
                <label for="data_vacinacao">Data da vacinação: </label>
                <input class="form-control" type="date" name="data_vacinacao" v-model="body.data_vacinacao" />
            </div>
            <div class="col-sm-2">
                <label for="id_dose">Identificação da dose: </label>
                <input class="form-control" type="text" name="id_dose" v-model="body.id_dose" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="00000000" />
            </div>
            <button type="submit" class="btn btn-success h-100" :disabled="disable">
                <span> Cadastrar </span>
            </button>
        </div>
    </form>
</template>
<script>
import pacientes from '../shared/select/paciente.vue'
import vacinas from '../shared/select/vacina.vue'

export default {
    name: 'historicoCadastro',
    components: {
        pacientes,
        vacinas
    },
    data() {
        return {
            body: {
                data_vacinacao: null,
                cod_paciente: null,
                cod_vacina: null,
                id_dose: null
            }
        }
    },
    computed: {
        disable() {
            return !this.body.data_vacinacao  || !this.body.cod_paciente
                || !this.body.cod_vacina || !this.body.id_dose
        }
    },
    methods: {
        async submit() {
            if (this.disable) return false;
            
            await this.$inertia.post('/historico', this.body);
        }
    }
}
</script>

<style scoped>
    button {
        margin-top: 31px;
    }
</style>