(setq *edges*
  '((A C) (F C) (A F) (E F) (A E) (D E) (E H) (K D) (G K) (B G) (B H) (G E)))
 
(setq *grades*
  '((A 5) (B 2) (C 7) (D 3) (E 5) (F 6) (G 12) (H 1) (K 7)))

(defun children (root edges)
  (cond
    ((null edges) nil)
    ((eq root (caar edges)) 
     (cons (cadar edges) (children root (cdr edges))))
    (t (children root (cdr edges)))))

(defun removenth (n list)
  (cond
    ((or (zerop n) (null list)) (cdr list))
    (t (cons (car list) (removenth (- n 1) (cdr list))))))

(defun indexof (element list n)
  (cond
    ((null list) nil)
    ((eq element (car list)) (+ n 0))
    (t (indexof element (cdr list) (+ n 1)))))

(defun getgrades (open)
  (cond
    ((null open) nil)
    (t (append (cdr (assoc (car open) *grades*)) (getgrades (cdr open))))))

(defun sortopen (open)
  (cond
    ((null open) nil)
    (t (cons
         (nth (indexof (apply 'max (getgrades open)) (getgrades open) 0) open)
         (sortopen (removenth (indexof (apply 'max (getgrades open)) (getgrades open) 0) open))))))

(defun notends (children ends)
  (cond
    ((null children) nil)
    ((member (car children) ends) (notends (cdr children) ends))
    (t (cons (car children) (notends (cdr children) ends)))))

(defun pathbest (open goal &optional beenlist ends)
  (cond
    ((eq (car open) goal) (reverse (cons goal beenlist)))
    ((null (notends (children (car open) *edges*) ends)) 
     (pathbest beenlist goal (cdr beenlist) (cons (car open) ends)))
    (t (pathbest (sortopen (notends (children (car open) *edges*) ends)) goal (cons (car open) beenlist) ends))))

(defun paths (open goal &optional beenlist)
  (cond
    ((null open) nil)
    ((member goal (children (car open) *edges*))
     (cons
       (reverse (cons goal (cons (car open) beenlist)))
       (append (paths (children (car open) *edges*) goal (cons (car open) beenlist))
               (paths (cdr (children (car open) *edges*)) goal (cons (car open) beenlist)))))
    (t (append (paths (children (car open) *edges*) goal (cons (car open) beenlist))
               (paths (cdr (children (car open) *edges*)) goal (cons (car open) beenlist))))))

(defun traverse (start goal &optional best)
  (if (and (atom start) (atom goal))
    (if best
      (pathbest (cons start '()) goal)
      (paths (cons start '()) goal))))

      
(traverse 'B 'H)
(traverse 'B 'H 'best)
(traverse 'B 'F)
(traverse 'B 'F 'best)
(traverse 'A 'C)
(traverse 'A 'C 'best)
