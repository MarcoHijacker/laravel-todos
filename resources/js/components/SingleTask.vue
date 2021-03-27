<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="sub-card">
                        <div class="card-header card-lello">
                           <span>Single Task</span>
                           <div class="action-buttons">
                                <a href="#" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                                <a href="#" type="button" class="btn btn-secondary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                <a href="#" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                           </div>
                        </div>
                    </div>
                    <div class="card-body">
                        I'm a fucking single task!
                        My name is {{ message }} and I'm a dick {{ title }} !
                        The list name is {{ checklist.name }} and the description is {{ checklist.description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: 'Prova',
                title: 'Head'
            };
        },
        props: {
            checklist: Object,
        },
        methods: {
            showAlert() {
                alert('Ciao belli!');
            }
        },
        computed: {

        }
    }
</script>