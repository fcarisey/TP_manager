let tabs = document.getElementById('subtabs').children[0].children;

Array.from(tabs).forEach(tab => {
    tab.addEventListener('click', e => {

        let timeout = setInterval(switchSubTab, 100)

        setTimeout(() => {
            clearTimeout(timeout)
        }, 100)
    })
})

if (switchSubTab() === false)
    document.getElementById('home').style.display = "block"

/**
 *
 * @returns {boolean}
 */
function switchSubTab() {
    const hash = window.location.hash.slice(1)

    if (hash === "")
        return false

    Array.from(tabs).forEach(tab => {
        document.getElementById(tab.children[0].href.split('#')[1]).style.display = "none"
    })

    let tab = document.getElementById(hash)

    if (tab === null)
        return false

    tab.style.display = "block"

    return true

}