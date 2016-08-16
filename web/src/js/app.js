var Sketch = {

    canvas: $('#js-sketch'),
    form: $('#sketch-form'),
    options: {
        color: '#fff',
    },

    getSketchActions: function() {
        return Sketch.canvas.sketch().actions
    },

    setSketchActions: function(actionJson) {

        actionJson = JSON.parse(actionJson);
        $.each(actionJson, function (i, val) {
            Sketch.canvas.sketch().actions.push(val);
            Sketch.canvas.sketch().redraw();
        });

    },

    events: function() {

        $(document).on({

            afterValidate: function (event, messages, deferreds) {
                if (deferreds.length) {
                    $('#js-create-sketch').show();
                }
                return false;
            }
        });

        $('#js-create-sketch').on('click', '', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $('#js-create-sketch').hide();

            var canvas = JSON.stringify(Sketch.getSketchActions());
            var image = Sketch.canvas.get(0).toDataURL();

            Sketch.form.find('#sketch-image').val(image);
            Sketch.form.find('#sketch-canvas').val(canvas);

            // submit form
            Sketch.form.yiiActiveForm('submitForm');
        });
    },

    init: function() {
        Sketch.events();
        Sketch.canvas.sketch(Sketch.options);
    },
};