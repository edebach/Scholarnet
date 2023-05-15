PGDMP     2                    {        
   Scholarnet    15.2    15.2     (           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            )           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            *           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            +           1262    16403 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    57367    commento    TABLE     �   CREATE TABLE public.commento (
    email character varying(50) NOT NULL,
    descrizione character varying(180),
    pubblicazione timestamp without time zone NOT NULL,
    titolo character varying(255) NOT NULL
);
    DROP TABLE public.commento;
       public         heap    postgres    false            �            1259    49255    compito    TABLE     q  CREATE TABLE public.compito (
    classe character varying(8) NOT NULL,
    titolo character varying(255) NOT NULL,
    testo text NOT NULL,
    allegati character varying(255),
    utente character varying(255) NOT NULL,
    data_scadenza date,
    ora time without time zone,
    pubblicazione timestamp without time zone NOT NULL,
    email character varying(50)
);
    DROP TABLE public.compito;
       public         heap    postgres    false            �            1259    49260    corso    TABLE     �   CREATE TABLE public.corso (
    codice character varying(8) NOT NULL,
    nome character varying(50) NOT NULL,
    materia character varying(50),
    link character varying(150) NOT NULL,
    link_imm character varying(150) NOT NULL
);
    DROP TABLE public.corso;
       public         heap    postgres    false            �            1259    49263    insegna    TABLE     v   CREATE TABLE public.insegna (
    docente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.insegna;
       public         heap    postgres    false            �            1259    49266 	   partecipa    TABLE     y   CREATE TABLE public.partecipa (
    studente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.partecipa;
       public         heap    postgres    false            �            1259    49269 
   recensione    TABLE       CREATE TABLE public.recensione (
    utente character varying(50) NOT NULL,
    data timestamp without time zone NOT NULL,
    stelle character varying(5) NOT NULL,
    descrizione character varying(250) DEFAULT NULL::character varying,
    nome_recensione character varying(100)
);
    DROP TABLE public.recensione;
       public         heap    postgres    false            �            1259    49273    utente    TABLE     �  CREATE TABLE public.utente (
    nome character varying(30) NOT NULL,
    cognome character varying(30) NOT NULL,
    email character varying(50) NOT NULL,
    pass character varying(100) NOT NULL,
    istituto character varying(50),
    sesso character varying(10) NOT NULL,
    "dataN" date NOT NULL,
    "flagStudente" boolean,
    telefono character varying(20) DEFAULT ''::character varying NOT NULL,
    data_iscrizione date
);
    DROP TABLE public.utente;
       public         heap    postgres    false            %          0    57367    commento 
   TABLE DATA           M   COPY public.commento (email, descrizione, pubblicazione, titolo) FROM stdin;
    public          postgres    false    220   '                 0    49255    compito 
   TABLE DATA           t   COPY public.compito (classe, titolo, testo, allegati, utente, data_scadenza, ora, pubblicazione, email) FROM stdin;
    public          postgres    false    214   8'                  0    49260    corso 
   TABLE DATA           F   COPY public.corso (codice, nome, materia, link, link_imm) FROM stdin;
    public          postgres    false    215   U'       !          0    49263    insegna 
   TABLE DATA           1   COPY public.insegna (docente, corso) FROM stdin;
    public          postgres    false    216   r'       "          0    49266 	   partecipa 
   TABLE DATA           4   COPY public.partecipa (studente, corso) FROM stdin;
    public          postgres    false    217   �'       #          0    49269 
   recensione 
   TABLE DATA           X   COPY public.recensione (utente, data, stelle, descrizione, nome_recensione) FROM stdin;
    public          postgres    false    218   �'       $          0    49273    utente 
   TABLE DATA           �   COPY public.utente (nome, cognome, email, pass, istituto, sesso, "dataN", "flagStudente", telefono, data_iscrizione) FROM stdin;
    public          postgres    false    219   �(       �           2606    49278    corso corso_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.corso
    ADD CONSTRAINT corso_pkey PRIMARY KEY (codice);
 :   ALTER TABLE ONLY public.corso DROP CONSTRAINT corso_pkey;
       public            postgres    false    215                       2606    57380    compito pk_compito 
   CONSTRAINT     c   ALTER TABLE ONLY public.compito
    ADD CONSTRAINT pk_compito PRIMARY KEY (pubblicazione, titolo);
 <   ALTER TABLE ONLY public.compito DROP CONSTRAINT pk_compito;
       public            postgres    false    214    214            �           2606    49280    partecipa pk_partecipa 
   CONSTRAINT     a   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT pk_partecipa PRIMARY KEY (studente, corso);
 @   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT pk_partecipa;
       public            postgres    false    217    217            �           2606    49282    recensione pk_recensione 
   CONSTRAINT     `   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT pk_recensione PRIMARY KEY (utente, data);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT pk_recensione;
       public            postgres    false    218    218            �           2606    49284    insegna primary_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT primary_key PRIMARY KEY (docente, corso);
 =   ALTER TABLE ONLY public.insegna DROP CONSTRAINT primary_key;
       public            postgres    false    216    216            �           2606    49286    utente utente_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utente DROP CONSTRAINT utente_pkey;
       public            postgres    false    219            �           2606    49287    compito compito_classe_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.compito
    ADD CONSTRAINT compito_classe_fkey FOREIGN KEY (classe) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.compito DROP CONSTRAINT compito_classe_fkey;
       public          postgres    false    215    3201    214            �           2606    57381    commento fk_commento    FK CONSTRAINT     �   ALTER TABLE ONLY public.commento
    ADD CONSTRAINT fk_commento FOREIGN KEY (pubblicazione, titolo) REFERENCES public.compito(pubblicazione, titolo) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 >   ALTER TABLE ONLY public.commento DROP CONSTRAINT fk_commento;
       public          postgres    false    214    220    220    214    3199            �           2606    49292    partecipa fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_corso;
       public          postgres    false    215    217    3201            �           2606    49297    insegna fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 :   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_corso;
       public          postgres    false    216    3201    215            �           2606    49302    insegna fk_docente    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_docente FOREIGN KEY (docente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_docente;
       public          postgres    false    219    216    3209            �           2606    49307    partecipa fk_studente    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_studente FOREIGN KEY (studente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 ?   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_studente;
       public          postgres    false    217    3209    219            �           2606    49312    recensione utente_recens_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT utente_recens_fk FOREIGN KEY (utente) REFERENCES public.utente(email) NOT VALID;
 E   ALTER TABLE ONLY public.recensione DROP CONSTRAINT utente_recens_fk;
       public          postgres    false    3209    218    219            %      x������ � �            x������ � �             x������ � �      !      x������ � �      "      x������ � �      #   �   x���AJ�@EםS����d�A�2�dЕ��t����+v:<���bv@jS���|�E/9	���j3Z$�K��*�ݶh�e�u[������K �-�ac�����؁M"�;\�mV*B��^GZ�Ǣ� �I�"v>� ?�0y�<1��vAo`������p�Z)��w�T�8��«g��'7.�d�������{>>�zx<t�����vh���z�V�h��/'b���<˲_��n�      $   �   x�}ν� ���p� %����Ȣ��)��$Rd��-��.�}���sX
!�Sr!�5���>M�P���n.8S���F	�P�������l�i���CM�؍�^1O�~`Bra�T0�0�f��H8�9,+�n�O+��}���.��\�E��*i�����׆1�M!L     