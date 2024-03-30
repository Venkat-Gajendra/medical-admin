class Effect {
  static Transitions = {
    linear: (pos) => pos,
    sinoidal: (pos) => (-Math.cos(pos * Math.PI) / 2) + .5,
    reverse: (pos) => 1 - pos,
    flicker: (pos) => {
      const rand = Math.random();
      return pos + rand / 4;
    },
    wobble: (pos) => (-Math.cos(pos * Math.PI * (9 * pos)) / 2) + .5,
    pulse: (pos, pulses) => (-Math.cos((pos * ((pulses || 5) - .5) * 2) * Math.PI) / 2) + .5,
    spring: (pos) => 1 - (Math.cos(pos * 4.5 * Math.PI) * Math.exp(-pos * 6)),
    none: (pos) => 0,
    full: (pos) => 1,
  };

  static DefaultOptions = {
    duration: 1.0,
    fps: 100,
    sync: false,
    from: 0.0,
    to: 1.0,
    delay: 0.0,
    queue: 'parallel',
  };

  static tagifyText(element) {
    const tagifyStyle = 'position:relative';
    if (Prototype.Browser.IE) tagifyStyle += ';zoom:1';

    element = $(element);
    const childNodes = Array.from(element.childNodes);
    childNodes.forEach((child) => {
      if (child.nodeType === 3) {
        const character = child.nodeValue;
        element.insertBefore(
          new Element('span', { style: tagifyStyle }).update(
            character === ' ' ? String.fromCharCode(160) : character
          ),
          child
        );
        element.removeChild(child);
      }
    });
  }

  static multiple(element, effect, options) {
    const elements = Array.isArray(element)
      ? element
      : Array.from(element.childNodes);

    const defaultOptions = {
      speed: 0.1,
      delay: 0.0,
    };
    const masterDelay = options.delay;

    elements.forEach((element, index) => {
      new effect(element, Object.assign({}, defaultOptions, { delay: index * defaultOptions.speed + masterDelay }));
    });
  }

  static toggle(element, effect, options) {
    element = $(element);
    effect = effect || 'appear';

    return Effect[Effect.PAIRS[effect][element.visible() ? 1 : 0]]($(element), Object.assign({
      queue: { position: 'end', scope: (element.id || 'global'), limit: 1 },
    }, options || {}));
  }
}

Effect.PAIRS = {
  slide: ['SlideDown', 'SlideUp'],
  blind: ['BlindDown', 'BlindUp'],
  appear: ['Appear', 'Fade'],
};

Effect.DefaultOptions.transition = Effect.Transitions.sinoidal;

// ... Rest of the code ...

Element.addMethods(Effect.Methods);
