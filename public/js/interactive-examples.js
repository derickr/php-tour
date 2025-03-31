import phpBinary from "/js/php-web.mjs";
import * as monaco from 'https://cdn.jsdelivr.net/npm/monaco-editor@0.39.0/+esm';

class PHP {
  static buffer = [];
  static runPhp = null;
  static version = '';
  static async loadPhp() {
    if (PHP.runPhp) {
      return PHP.runPhp;
    }

    const { ccall } = await phpBinary({
      print(data) {
        if (!data) {
          return;
        }

        if (PHP.buffer.length) {
          PHP.buffer.push("\n");
        }
        PHP.buffer.push(data);
      },
    });

    PHP.version = ccall("phpw_exec", "string", ["string"], ["phpversion();"]),
    console.log("PHP wasm %s loaded.", PHP.version);
    PHP.runPhp = (code) => ccall("phpw_run", null, ["string"], ["?>" + code]);
    return PHP.runPhp;
  }
}

async function main() {
  let lastOutput = null;
  const outputContainer = document.getElementById('outputContainer');
  const outputDiv = document.getElementById('outputDiv');

  document.querySelectorAll(".example .example-contents").forEach((example) => {
    const phpcode = example.querySelector(".phpcode");
    if (phpcode === null) {
      return;
    }
    var codeData = phpcode.innerText
    phpcode.innerText = '';

    const editor = monaco.editor.create(document.getElementById('monaco'));
    const model = editor.getModel();
    model.setLanguage('php');
    model.setValue(codeData);

    const resetButton = document.createElement("button");
    resetButton.setAttribute("type", "button");
    resetButton.innerText = "Reset code";
    resetButton.onclick = async function () {
      model.setValue(codeData);
    };
    example.parentNode.after(resetButton);

    const runButton = document.createElement("button");
    runButton.setAttribute("type", "button");
    runButton.innerText = "Run code";
    runButton.onclick = async function () {
      const runPhp = await PHP.loadPhp();
      runPhp(model.getValue());
      outputDiv.innerText = PHP.buffer.join("");
      outputContainer.setAttribute('style', 'display: initial');
      PHP.buffer.length = 0;
    };
    example.parentNode.after(runButton);
  });
}

main();
