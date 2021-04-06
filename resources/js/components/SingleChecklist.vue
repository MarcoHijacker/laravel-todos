<template>
    <div style="margin-bottom: 20px;" class="card">
        <div class="card-header single-list checklist-item">
            <span class="checklist-title">
                <a href="">
                    Nome checklist
                </a>
            </span>
            <div>
                <a
                    href=""
                    type="button"
                    class="btn btn-success btn-sm"
                    ><i class="fa fa-eye"></i> Open</a
                >
                <a
                    href=""
                    type="button"
                    class="btn btn-primary btn-sm"
                    ><i class="fa fa-pencil-square-o"></i> Edit</a
                >
                <a
                    href=""
                    type="button"
                    class="btn btn-danger btn-sm"
                    ><i class="fa fa-trash-o"></i> Delete</a
                >
            </div>
        </div>

        <div class="card-body">
            <div class="checklist-content">
                <div class="checklist-info">
                    <p>Description: Blabla</p>
                    <p>
                        Completed Tasks:
                        <span class="checklist-field">
                            5
                        </span>
                    </p>
                    <p>
                        Overall Tasks:
                        <span class="checklist-field">
                            10
                        </span>
                    </p>
                </div>
                <div class="checklist-bar">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            
        },
        props: {

        },
        methods: {

        }
    }
</script>