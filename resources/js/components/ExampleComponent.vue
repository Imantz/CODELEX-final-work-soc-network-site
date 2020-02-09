<template>
    <div class="hello">
        <picture-input
            ref="pictureInput"
            width="300"
            height="300"
            margin="16"
            accept="image/jpeg,image/png"
            size="10"
            button-class="btn"
            :custom-strings="{
        upload: '<h1>Bummer!</h1>',
        drag: 'Drag a 😺 PIC or GTFO'
      }"
            @change="onChange">
        </picture-input>
    </div>
</template>

<script>
    import PictureInput from 'vue-picture-input'

    export default {
        components: {
            PictureInput
        },
        methods: {
            onChange (image) {
                console.log('New picture selected!')
                if (image) {
                    console.log('Picture loaded.')
                    this.image = image
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            },
        }
    }
</script>
