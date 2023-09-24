<template>
    <div>
        <button class="btn btn-dark" v-on:click="show_form_category()">大項目追加</button>
        <div v-if="is_visible_form_category">
            <form action="/post/category" method="post">
                <label for="category">大項目</label>
                <input type="text" name="category" id="category">
                <input type="submit" value="送信" class="btn btn-dark">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                is_visible_form_category: false
            };
        },
        methods: {
            show_form_category: function () {
                if(this.is_visible_form_category)
                {
                    this.is_visible_form_category = false;
                }else{
                    this.is_visible_form_category = true;

                }
            }
        }
    }

</script>