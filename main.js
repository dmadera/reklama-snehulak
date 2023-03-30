function showAndHideNavsByScroll() {
    var scroll = $(window).scrollTop()
    if (scroll < 20) {
        $(".navbar").addClass("d-lg-none")
        $(".title-navbar").removeClass("d-none")
    } else {
        $(".title-navbar").addClass("d-none")
        $(".navbar").removeClass("d-lg-none")
    }
}

function randomIntFromInterval(min, max) {
    let result = Math.floor(Math.random() * (max - min + 1) + min)
    if (result < min) {
        result = min
    } else if (result > max) {
        result = max
    }
    return result
}

let rand = randomIntFromInterval(0, 1)
console.log(rand)
if (rand == 0) {
    $("header").addClass("lipa")
    $(".led-img-sm").attr("src", "./layout/led1.jpg")
}

$(function () {
    $("a").on("click", function (event) {
        if (this.hash !== "") {
            event.preventDefault()
            var hash = this.hash
            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top,
                },
                300,
                function () {
                    window.location.hash = hash
                }
            )
        }
    })
    showAndHideNavsByScroll()
    $(document).on("scroll", function (event) {
        showAndHideNavsByScroll()
    })
})

function initMap() {
    var location = { lat: 50.776201, lng: 15.036313 }
    var map = new google.maps.Map(document.getElementById("map_container"), {
        center: location,
        zoom: 17,
    })

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "LED Reklama Sněhulák",
    })
}

var request

function onSubmit(token) {
    $("#contactForm").submit()
}

$("#contactForm").submit(function (event) {
    event.preventDefault()

    var form = $(this)
    var inputs = form.find("input, select, button, textarea")
    var form_array = form.serializeArray()
    var data = form.serialize()

    inputs.prop("disabled", true)

    if (request) {
        request.abort()
    }
    console.log(data)

    request = $.ajax({
        url: "src/contact-form.php",
        type: "POST",
        dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        data: data,
    })

    request.done(function (response, textStatus, jqXHR) {
        console.log(response)

        if (response.success) {
            form[0].reset()
            showMessage("message-success", response)
        } else {
            showMessage("message-failure", response.error)
        }
    })

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error(
            "The following error occurred: ",
            jqXHR,
            textStatus,
            errorThrown
        )
        showMessage("message-failure", errorThrown)
    })

    request.always(function () {
        inputs.prop("disabled", false)
    })
})

$(document).ready(function () {
    var mainModal = $(".main_modal")
    if (mainModal.attr("data-enabled") == "1") {
        mainModal.modal("show")
    }
})

function showMessage(type, details) {
    var modal = $("#modal-info")

    switch (type) {
        case "message-success":
            setModalData(
                modal,
                "Zpráva",
                `
          Děkujeme za zprávu.<br>
          Budeme Vás kontaktovat na email ihned, jak to bude možné.<br>
        `
            )
            break

        case "message-failure":
            setModalData(
                modal,
                "Chyba odeslání zprávy",
                `
          Zprávu se nepodařilo odeslat.
          Zkotrolujte, zda máte správně vyplněný formulář z zkuste to znovu.<br>
          V případě dalšího selhání nás kontaktujte, prosím, přímo na emailu - info@reklama-snehulak.cz.<br>
          Děkujeme.<br>
          <br>
          Detail chyby: ` +
                    JSON.stringify(details) +
                    `
        `
            )
            break
    }
    modal.modal("show")
}

function setModalData(modal, title, body) {
    modal.find(".modal-title").text(title)
    modal.find(".modal-text").html(body)
}
