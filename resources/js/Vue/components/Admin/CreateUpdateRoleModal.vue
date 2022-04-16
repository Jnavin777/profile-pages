<template>
    <b-modal
        id="modal-role"
        ref="modal"
        :title="action === CREATE ? 'Create role' : 'Update role #'+role.id"
        @hidden="resetModal"
        @ok="handleOk"
    >
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input">
                <b-form-input
                    id="name-input"
                    v-model="role.name"
                    required
                ></b-form-input>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdateRoleModal",
    props: ['action', 'role'],
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE'
        }
    },
    methods: {
        handleOk() {
            let self = this;
            if(this.action === this.CREATE) {
                axios.post(window.routes.role_store, this.role)
                    .then((response)=>{
                        self.$emit('updateRole')
                    });
            } else if(this.action === this.UPDATE) {
                axios.put('/admin/role/'+this.role.id, this.role)
                    .then((response)=>{
                        self.$emit('updateRole')
                    })
            }
        },
        resetModal(){
            this.$emit('resetRoleModal')
        }
    },
    created() {
        this.resetModal();
    }
}
</script>
